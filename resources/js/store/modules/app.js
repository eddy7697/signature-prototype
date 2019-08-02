const state = {
    loading: false,
    exception: {
        rand: null,
        code: 0,
    }
}

const actions = {
    isLoading({ commit }, status) {
        commit('PAGELODING', status)
    },
    handleException({ commit }, code) {
        commit('HANDLE_EXCEPTION', code)
    }
}

const mutations = {
    PAGELODING(state, status) {
        state.loading = status
    },
    HANDLE_EXCEPTION(state, code) {
        state.exception.rand = Math.round(Math.random() * 1000000)
        state.exception.code = code
    }
}

export default {
    namespaced: true,
    state,
    actions,
    mutations
}