/**
 * 錯誤處理函式
 * 
 * 解析後，透過Vuex將錯誤訊息以及status code儲存至最上層APP
 * 若有登入失效情況，則在此處進行client logout
 * 
 * @param err Error statement
 * @param callback Callback function
 */
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