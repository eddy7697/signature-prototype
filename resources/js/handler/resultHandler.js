export function resultHandler(vue, res, callback) {
    let store = vue.$store,
        msg = vue.$message

    if (typeof(res.data.error) !== 'undefined') {
        switch (res.data.error) {
            case 'Token not provided':
                store.dispatch('auth/tokenExpired')
                msg.error('無效的登入權杖')
                break;
            case 'TOKEN_INVALID':
                store.dispatch('auth/tokenExpired')
                msg.error('登入權杖失效')
            case 'TOKEN_EXPIRED':
                store.dispatch('auth/tokenExpired')
                msg.error('登入逾時')
            default:
                break;
        }

        return
    }

    if (typeof(callback) == 'function') {
        callback()    
    }
}