<template>
    <div>
        <Edit></Edit>
        <a-table
                :columns="columns"
                :dataSource="data"
                rowKey = 'id'
        >
            <template slot="operation" slot-scope="text, record, index">
                <div class="editable-row-operations">
        <span>
          <a @click="() => edit(record)"><i class="fas fa-pencil-alt" ></i></a>&nbsp;&nbsp;
            <a @click="() => show()"><i class="fas fa-trash-alt"></i></a>
        </span>
                </div>
                <div>
                    <a-modal
                            title="Xác thực"
                            style="top: 20px;"
                            :visible="modal1Visible"
                            @ok="() => ok(record)"
                            @cancel="() => cancel()"
                    >
                        Bạn có chắc chắn muốn xóa
                    </a-modal>
                </div>

            </template>
        </a-table>
    </div>
</template>
<script>
    import Edit from './Edit';
    import {store, actions} from "../../categoryStore";
    const columns = [
        {
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
        },
        {
            title: 'Chuyên ngành',
            dataIndex: 'majors',
            key: 'majors',
        },
        {
            title: 'Đơn vị cấp',
            dataIndex: 'competent_units',
            key: 'competent_units',
        }, {
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
                modal1Visible: false
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
                axios.get('http://127.0.0.1:8000/api/listQualification').then(response => {
                    if (response.data && response.data.status === 200) {
                        this.data = response.data.data;
                        console.log(this.data)
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
            },edit(record) {
                actions.update(true, record)
            },ok(record) {
                axios.post('http://127.0.0.1:8000/api/deleteQulification', record).then(response => {
                    if (response.data.status === 200) {
                        console.log("xóa thành công")
                        location.reload();
                        this.$message.success('xóa thành công');
                        this.$notification['success']({
                            message: 'xóa thành công',
                        });
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
            }, show(){
                this.modal1Visible = true
            },cancel(){
                this.modal1Visible = false
            },
        }
    }
</script>
<style lang="scss" scoped>
    .list{
        background: #ffffff;
    }
</style>