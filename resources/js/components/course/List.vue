<template>
    <div>
        <Edit></Edit>
        <a-table
                :columns="columns"
                :dataSource="data"
                rowKey='id'
        >
            <template slot="operation" slot-scope="text, record, index">
                <div class="editable-row-operations">
        <span>
          <a @click="() => edit(record)"><i class="fa fa-pencil edit" aria-hidden="true"></i> Edit</a>

        </span>
                </div>
            </template>
        </a-table>
    </div>
</template>
<script>
    import Edit from './Edit';
    import {store,actions} from "../../categoryStore";
    const columns = [
        {
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
        },
        {
            title: 'Tên Khóa học',
            dataIndex: 'name',
            key: 'name',
        },
        {
            title: 'Thời gian học',
            dataIndex: 'date_training',
            key: 'date_training',
        },
        {
            title: 'Học phí',
            dataIndex: 'tuition',
            key: 'tuition',
        },{
            title: 'Hành động',
            dataIndex: 'operation',
            key: 'operation',
            scopedSlots: {customRender: 'operation'},
        },

    ];
    export default {
        data() {
            return {
                data: [],
                columns,
            }
        },
        components: {
            Edit
        },
        mounted() {
            this.getCourse()
        },
        methods: {
            getCourse() {
                axios.get('http://127.0.0.1:8000/api/listCourse').then(response => {
                    if (response.data && response.data.status === 200) {
                        this.data = response.data.data;
                        console.log(this.data)
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
            },edit(record) {
                actions.update(true, record)
            }
        }
    }
</script>
<style lang="scss" scoped>
    .list {
        background: #ffffff;
    }
</style>