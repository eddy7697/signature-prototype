<template>
	<div class="app-conatiner">
		<router-view />
		<div class="loading-mask" v-if="isLoading">
			<a-icon type="loading" class="loading-icon" />
		</div>		
	</div>    
</template>
<script>
import { handler } from '../exception'

export default {
	data(){
		return {
		}
	},
	beforeCreate() {
        this.$store.dispatch('auth/checkAuth')
	},
	mounted() {
		this.$nextTick(() => {
			this.checkAuth()
		})
	},
	computed: {
		auth() {
			return this.$store.state.auth.token
		},
		isLoading() {
			return this.$store.state.app.loading
		},
		exception() {
			return this.$store.state.app.exception
		}
	},
	watch: {
		$route(to, from) {
			if (this.chackAuth) {
				this.chackAuth()	
			}
		},
		auth(token) {
			this.checkAuth()
		},
		/**
		 * 監聽是否有錯誤訊息
		 */
		exception: {
			handler(excep) {
				this.$message.error(handler(excep.code))
			},
			deep: true
		}
	},
	methods: {
		checkAuth() {
			if (!this.$store.state.auth.token) {
				this.$router.push('/admin/login')
			} else {
				if (this.$route.path == '/admin/login') {
					this.$router.push('/admin')
				}
			}
		}
	}
}
</script>

<style lang="scss">
.anticon {
	vertical-align: 0.1rem;
}
.app-conatiner {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
	bottom: 0;

	.loading-mask {
		position: fixed;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		font-size: 34px;
		background-color: rgba($color: #fff, $alpha: .5);

		.loading-icon {
			position: absolute;
			top: 46%;
			left: 50%;	
			transform: translate(-50%, -50%);
		}
	}
}
</style>
