export function resultHandler(msg, res, callback, store) {
    if (typeof(res.data.error) !== 'undefined') {
        switch (res.data.error) {
            case 'Token not provided':
                store.dispatch('auth/tokenExpired')
                msg.error('無效的登入權杖')
                break;
            case 'TOKEN_INVALID':
                store.dispatch('auth/tokenExpired')
                msg.error('登入權杖失效')
            default:
                break;
        }

        return
    }
    callback()
}