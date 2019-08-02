import { authHeader } from '../../auth'

const state = {
    token: null,
    user: {}
}

const actions = {
    login({ commit }, vo) {
        commit('app/PAGELODING', true, { root: true })
        axios.post('/api/auth/login', vo)
            .then(res => {
                localStorage.setItem('user', JSON.stringify(res.data))
                commit('AUTHENCATION_VALID', res.data)
            }).catch(err => {
                localStorage.removeItem('user')
                commit('app/HANDLE_EXCEPTION', 1001, { root: true })
            }).then(() => {
                commit('app/PAGELODING', false, { root: true })
            })
    },
    logout({ commit }) {
        commit('app/PAGELODING', true, { root: true })

        axios.post('/api/auth/logout')
            .then(res => {
                localStorage.removeItem('user')
                commit('AUTHENCATION_FAILURE')    
                commit('app/PAGELODING', false, { root: true })
            })
    },
    tokenExpired({ commit }) {
        localStorage.removeItem('user')
        commit('AUTHENCATION_FAILURE')    
    },
    checkAuth({ commit }) {
        commit('AUTHENCATION_VALID', authHeader())
    }
}

const mutations = {
    AUTHENCATION_VALID(state, auth) {
        state.token = auth.token ? `Bearer ${auth.token}` : null
        state.user = auth.user
        
        window.axios.defaults.headers.common['Authorization'] = auth.token ? `Bearer ${auth.token}` : null
    },
    AUTHENCATION_FAILURE(state) {
        state.token = null
        state.user = new Object

        window.axios.defaults.headers.common['Authorization'] = null
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}