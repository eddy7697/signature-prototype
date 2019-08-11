<template>
    <div>
        <el-table
            :data="pageData.data"
            border
            style="width: 100%">
            <el-table-column
                prop="date"
                label="日期"
                width="180">
            </el-table-column>
            <el-table-column
                prop="name"
                label="姓名"
                width="180">
            </el-table-column>
            <el-table-column
                prop="address"
                label="地址">
            </el-table-column>
        </el-table>
    </div>
</template>

<script>
import {resultHandler} from '../../../handler/resultHandler'

export default {
    data() {
        return {
            urlPath: '/api/admin/get',
            pageData: new Object
        }
    },
    created() {
        this.getData()
    },
    methods: {
        getData() {
            this.$store.dispatch('app/isLoading', true)
            axios.post(this.urlPath)
                .then(res => {
                    resultHandler(this, res, () => {
                        this.pageData = res.data
                    })
                }).catch(err => {
                    resultHandler(this, res)
                }).then(() => {
                    this.$store.dispatch('app/isLoading', false)
                })
        }
    },
}
</script>