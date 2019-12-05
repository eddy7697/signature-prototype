
export default {
    methods: {
        errorHandler(err, callback) {
            let status = err.response.status

            if (status == 401 || status == 403) {
                this.$store.dispatch('auth/tokenExpired')
            }

            this.$store.dispatch('app/handleException', err.response.status)

            if (typeof(callback) !== "undefined") {
                callback()    
            }
        }
    },
}