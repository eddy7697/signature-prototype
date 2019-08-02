<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card login-card">
                    <div class="card-body">
                        <div class="card-title" style="margin-bottom: 30px;">
                            <a-divider orientation="left">系統登入</a-divider>
                        </div>
                        <login-form />
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
import LoginForm from './Components/login/LoginForm.vue'

export default {
    beforeCreate () {
        // this.form = this.$form.createForm(this);
    },
    components: {LoginForm},
    methods: {
        handleSubmit (e) {
            e.preventDefault();
            this.form.validateFields((err, values) => {
                if (!err) {
                console.log('Received values of form: ', values);
                }
            });
        },
    },
};
</script>

<style lang="scss">
.login-card {
    max-width: 450px;
    width: 100%;
    margin: 8rem auto 0 auto;
}

.ant-divider-horizontal.ant-divider-with-text-left:before {
    width: 50% !important;
}
</style>
