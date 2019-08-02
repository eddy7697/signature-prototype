<template>
    <a-layout id="components-layout-demo-custom-trigger">
        <a-layout-sider
        :trigger="null"
        width="300px"
        collapsible
        v-model="collapsed">
            <div class="logo" >
                <img src="/img/logo.png" alt="">
            </div>
            
            <a-menu theme="dark" mode="inline" :defaultSelectedKeys="['1']">
                <a-menu-item key="1">
                    <router-link to="/admin">
                        <a-icon type="dashboard" />
                        <span>首頁</span>
                    </router-link>
                </a-menu-item>
                <a-sub-menu key="sub1">
                    <span slot="title">
                        <a-icon type="user" />
                        <span>使用者管理</span>
                    </span>
                    <a-menu-item key="5">
                        <router-link to="/admin/admin">
                            <a-icon type="team" />
                            <span>管理者列表</span>
                        </router-link>
                    </a-menu-item>
                    <a-menu-item key="6">
                        <router-link to="/admin/user">
                            <a-icon type="smile" />
                            <span>使用者列表</span>
                        </router-link>
                    </a-menu-item>
                </a-sub-menu>
                <a-menu-item key="3">
                    <router-link to="/admin/form">
                        <a-icon type="snippets" />
                        <span>表單管理</span>
                    </router-link>
                </a-menu-item>
            </a-menu>
        </a-layout-sider>
        <a-layout>
            <a-layout-header style="background: #fff; padding: 0">
                <a-col :span="12">
                    <a-icon
                    class="trigger"
                    :type="collapsed ? 'menu-unfold' : 'menu-fold'"
                    @click="()=> collapsed = !collapsed" />
                </a-col>
                <a-col :span="12" style="text-align: right">
                    <a class="logout-btn" @click="logout">
                        <a-icon type="logout" />&nbsp;&nbsp;
                        登出
                    </a>
                    
                </a-col>
            </a-layout-header>
            <a-layout-content :style="{ margin: '24px 16px', padding: '24px', background: '#fff', minHeight: '280px' }">
                <router-view/>
            </a-layout-content>
        </a-layout>
    </a-layout>
</template>
<script>
export default {
    data(){
        return {
        collapsed: false,
        }
    },
    methods: {
        logout() {
            this.$store.dispatch('auth/logout')
        }
    }
}
</script>

<style lang="scss">
#app {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
}
#components-layout-demo-custom-trigger {
    height: 100%;

    .trigger {
        font-size: 18px;
        line-height: 64px;
        padding: 0 24px;
        cursor: pointer;
        transition: color .3s;

        &:hover {
            color: #1890ff;
        }
    }
    .logout-btn {
        line-height: 64px;
        padding: 0 24px;
        cursor: pointer;
        transition: color 0.3s;
    }
    .logo {
        // height: 32px;
        // background: rgba(255, 255, 255, 0.2);
        margin: 16px;

        img {
            width: 100%;
        }
    }
}
</style>
