<template>
    <div>
        <Edit></Edit>
        <a-table
                :columns="columns"
                :dataSource="data"
                rowKey = 'id'
        >

        </a-table>
    </div>
</template>
<script>
    import Edit from './Edit';
    const columns = [
        {
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
        },
        {
            title: 'Tên học viên',
            dataIndex: 'student',
            key: 'student',
        },
        {
            title: 'Lớp',
            dataIndex: 'class',
            key: 'class',
        },
        {
            title: 'Học phí',
            dataIndex: 'tuition',
            key: 'tuition',
        },{
            title: 'Giảm giá',
            dataIndex: 'sale',
            key: 'sale',
        },{
            title: 'Số tiền phả trả',
            dataIndex: 'pay',
            key: 'pay',
        },{
            title: 'Trả lần 1',
            dataIndex: 'pay1',
            key: 'pay1',
        },{
            title: 'Trả lần 2',
            dataIndex: 'pay2',
            key: 'pay2',
        },{
            title: 'Còn lại',
            dataIndex: 'rest',
            key: 'rest',
        },{
            title: 'Trạng thái',
            dataIndex: 'status',
            key: 'status',
        },

    ];
    export default {
        data() {
            return {
                data: [],
                columns,
            }
        },
        components:{
          Edit
        },
        mounted() {
            this.getCourse()
        },
        methods: {
            getCourse(){
                axios.get('http://127.0.0.1:8000/api/listPay').then(response => {
                    if (response.data && response.data.status === 200) {
                        this.data = response.data.data;
                        console.log(this.data)
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
            }
        }
    }
</script>
<style lang="scss" scoped>
    .list{
        background: #ffffff;
    }
</style>