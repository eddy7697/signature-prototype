<template>
    <div class="container">
        <button @click="clearPad">Clear</button>
        <button @click="saveSign">Save</button>
        <input type="range" name="pw" min="1" max="10" value="2" v-model="lineWidth">
        <input type="color" v-model="strokeStyle">
        <div class="canvas-container">
            <canvas id="myCanvas" 
                ref="myCanvas"
                v-if="canvasInitialized"
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
            let canvas = this.$refs.myCanvas
            
            this.canvasWidth = container.width()
            this.canvasHeight = container.height()

            canvas.addEventListener('mousedown', this.mouseDown);
            canvas.addEventListener('mousemove', this.mouseMove);
            canvas.addEventListener('mouseup', this.mouseUp);

            canvas.addEventListener('touchstart', this.touchStart);
            canvas.addEventListener('touchmove', this.touchMove);
            canvas.addEventListener('touchend', this.touchEnd);

            this.$nextTick(() => {
                this.ctx = canvas.getContext('2d')
            })
        },
        data() {
            let container = $('.canvas-container')

            return {
                csrftoken: document.head.querySelector('meta[name="csrf-token"]').content,
                strokeStyle: '#000000',
                lineWidth: 2,
                canvasWidth: container.width(),
                canvasHeight: container.height(),
                canvasInitialized: true,
                imageBase64: null,

                /**
                 * canvas
                 */
                draw: false,
                ctx: null,
            }
        },
        methods: {
            saveSign() {
                let c = this.$refs.myCanvas
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
            getMousePos(event) {
                var rect = this.$refs.myCanvas.getBoundingClientRect()

                return {
                    x: event.clientX - rect.left,
                    y: event.clientY - rect.top
                };   
            },
            mouseDown(e) {
                let mousePos = this.getMousePos(e)

                e.preventDefault()

                this.ctx.strokeStyle = this.strokeStyle
                this.ctx.lineWidth = this.lineWidth
                this.ctx.beginPath()
                this.ctx.moveTo(mousePos.x, mousePos.y)

                this.draw = true                
            },
            mouseMove(e) {
                if (this.draw) {
                    let mousePos = this.getMousePos(e)

                    this.ctx.lineTo(mousePos.x, mousePos.y)
                    this.ctx.stroke()                    
                }
            },
            mouseUp(e) {
                this.draw = false
            },
            touchStart(e) {
                let mousePos = this.getMousePos(e.targetTouches[0])

                e.preventDefault()

                this.ctx.strokeStyle = this.strokeStyle
                this.ctx.lineWidth = this.lineWidth
                this.ctx.beginPath()
                this.ctx.moveTo(mousePos.x, mousePos.y)

                this.draw = true
            },
            touchMove(e) {
                if (this.draw) {
                    let mousePos = this.getMousePos(e.targetTouches[0])

                    this.ctx.lineTo(mousePos.x, mousePos.y)
                    this.ctx.stroke() 
                }
            },
            touchEnd(e) {
                this.draw = false
            },
            clearPad(){
                var canvas = this.$refs.myCanvas
                var ctx = canvas.getContext("2d")

                ctx.clearRect(0, 0, this.canvasWidth, this.canvasHeight)
            }
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