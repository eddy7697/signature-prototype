<template>
    <div class="container">
        <button>Clear</button>
        <button @click="saveSign">Save</button>
        <input type="range" name="pw" min="1" max="10" value="2" v-model="lineWidth">
        <input type="color" v-model="strokeStyle">
        <div class="canvas-container">
            <canvas id="canvas" 
                v-if="canvasInitialized"
                v-on:mousedown="handleMouseDown" 
                v-on:mouseup="handleMouseUp" 
                v-on:mousemove="handleMouseMove" 
                :width="`${canvasWidth}px`" :height="`${canvasHeight}px`">

            </canvas>
        </div>
        <form id="sign_form" action="/api/sign/save" method="post" style="display: none">
            <input type="hidden" name="_token" v-model="csrftoken">
            <textarea name="imageBase64" id="" cols="30" rows="10" v-model="imageBase64"></textarea>
        </form>
    </div>
</template>

<script>
    import FileDownload  from 'js-file-download'

    export default {
        mounted() {
            let container = $('.canvas-container')
            
            this.canvasWidth = container.width()
            this.canvasHeight = container.height()

            this.$nextTick(() => {
                this.canvasInitialized = true
            })
        },
        data() {
            let container = $('.canvas-container')

            return {
                csrftoken: document.head.querySelector('meta[name="csrf-token"]').content,
                strokeStyle: '#000000',
                lineWidth: 2,
                mouse: {
                    current: {
                        x: 0,
                        y: 0
                    },
                    previous: {
                        x: 0,
                        y: 0
                    },
                    down: false
                },
                canvasWidth: container.width(),
                canvasHeight: container.height(),
                canvasInitialized: false,
                imageBase64: null
            }
        },
        computed: {
            currentMouse() {
                var c = document.getElementById("canvas");
                var rect = c.getBoundingClientRect();
                
                return {
                    x: this.mouse.current.x - rect.left,
                    y: this.mouse.current.y - rect.top
                }
            }
        },
        methods: {
            saveSign() {
                let c = document.getElementById("canvas")
                let vo = {
                    imageBase64: c.toDataURL()
                }

                this.imageBase64 = c.toDataURL()

                this.$nextTick(() => {
                    document.getElementById('sign_form').submit()
                })
                return

                axios.post('/api/sign/save', vo)
                    .then(response => {
                        FileDownload(response.data, 'result.pdf');
                    })
            },
            draw(event) {
                if (this.mouse.down) {
                    var c = document.getElementById("canvas");

                    var ctx = c.getContext("2d");

                    ctx.clearRect(0, 0, this.canvasWidth, this.canvasHeight);


                    ctx.lineTo(this.currentMouse.x, this.currentMouse.y);
                    ctx.strokeStyle = this.strokeStyle;
                    ctx.lineWidth = this.lineWidth;
                    ctx.imageSmoothingEnabled = true
                    ctx.stroke()
                }

            },
            handleMouseDown(event) {
                this.mouse.down = true;
                this.mouse.current = {
                    x: event.pageX,
                    y: event.pageY
                }

                var c = document.getElementById("canvas");
                var ctx = c.getContext("2d");

                ctx.moveTo(this.currentMouse.x, this.currentMouse.y)


            },
            handleMouseUp() {
                this.mouse.down = false;
            },
            handleMouseMove(event) {

                this.mouse.current = {
                    x: event.pageX,
                    y: event.pageY
                }

                this.draw(event)

            },
            
        },
        ready() {
            console.log(123);
            
            var c = document.getElementById("canvas");
            var ctx = c.getContext("2d");
            ctx.translate(0.5, 0.5);
            ctx.imageSmoothingEnabled = false;
            // this.draw();
        }
    }
</script>

<style lang="scss">
.canvas-container {
    position: absolute;
    top: 50px;
    left: 10px;
    right: 10px;
    bottom: 10px;
    border: #eee thin solid;
    box-shadow: 2px 2px 12px -2px rgba($color: #000000, $alpha: .4);
    border-radius: 2px;
}    
</style>