<template>
    <div>
        <a-form
            id="components-form-demo-normal-login"
            :form="form"
            class="login-form"
            @submit="handleSubmit">
            <a-form-item>
            <a-input
                v-decorator="[
                    'userName',
                    { rules: [{ required: true, message: '請輸入您的帳號' }] }
                ]"
                placeholder="帳號">
                    <a-icon
                    slot="prefix"
                    type="user"
                    style="color: rgba(0,0,0,.25)" />
            </a-input>
            </a-form-item>
            <a-form-item>
            <a-input
                v-decorator="[
                    'password',
                    { rules: [{ required: true, message: '請輸入您的密碼' }] }
                ]"
                type="password"
                placeholder="密碼">
                    <a-icon
                    slot="prefix"
                    type="lock"
                    style="color: rgba(0,0,0,.25)" />
            </a-input>
            </a-form-item>
            <a-form-item>
                <!-- <a-checkbox
                    v-decorator="[
                    'remember',
                    {
                        valuePropName: 'checked',
                        initialValue: true,
                    }
                    ]">
                    記住我
                </a-checkbox> -->
                <a class="login-form-forgot" href="" >
                    Forgot password
                </a>
                <a-button
                    type="primary"
                    html-type="submit"
                    class="login-form-button" >
                    Log in
                </a-button>
                Or <a href="#" @click="testAC">
                    點我註冊
                </a>
            </a-form-item>
        </a-form>
    </div>
    
</template>

<script>

export default {
	beforeCreate () {
		this.form = this.$form.createForm(this);
	},
	methods: {
		handleSubmit (e) {
			e.preventDefault();
			this.form.validateFields((err, values) => {
				if (!err) {
                    let vo = {
                        email: values.userName,
                        password: values.password
                    }

                    this.$store.dispatch('auth/login', vo)
				}
			});
        },
        testAC() {
            console.log(this.$store.state.auth)

            this.$store.dispatch('auth/checkAuth')
        }
	},
};
</script>
<style>
#components-form-demo-normal-login .login-form {
  	max-width: 300px;
}
#components-form-demo-normal-login .login-form-forgot {
  	float: right;
}
#components-form-demo-normal-login .login-form-button {
  	width: 100%;
}
</style>