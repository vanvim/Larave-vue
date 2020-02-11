<template>
    <div>
        <Edit></Edit>
        <a-table
                :columns="columns"
                :dataSource="data"
                rowKey = 'id'
        >
            <div slot="image_name" slot-scope="text, record, index">
                <img :src="'./img/'+record.image_name" width="100px">
            </div>
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
            title: 'img',
            dataIndex: 'image_name',
            key: 'image_name',
            scopedSlots: { customRender: 'image_name' },
        }
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
                axios.get('http://127.0.0.1:8000/api/lisImg').then(response => {
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