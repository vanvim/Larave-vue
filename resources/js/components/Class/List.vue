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
            <div slot="start_time" slot-scope="text, record, index">

                {{ getHumanDate(record.start_time) }}
            </div>
        </a-table>
    </div>
</template>
<script>
    import Edit from './Edit';
    import {store, actions} from "../../categoryStore";
    import moment from 'moment';

    const columns = [
        {
            title: 'ID',
            dataIndex: 'id',
            key: 'id',
        },
        {
            title: 'Tên lớp học',
            dataIndex: 'name',
            key: 'name',
        },
        {
            title: 'Sĩ số',
            dataIndex: 'number',
            key: 'number',
        },
        {
            title: 'Ngày bắt đầu',
            dataIndex: 'start_time',
            key: 'start_time',
            scopedSlots: {customRender: 'start_time'},
        }, {
            title: 'Giảng viên',
            dataIndex: 'teacher',
            key: 'teacher',
        }, {
            title: 'Khóa học',
            dataIndex: 'course',
            key: 'course',
        },
        {
            title: 'Lịch học',
            dataIndex: 'schedule',
            key: 'schedule',
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
        components: {
            Edit
        },
        mounted() {
            this.getCourse()
        },
        methods: {
            getHumanDate(date) {
                var dateString = moment(String(date)).format('DD/MM/YYYY')
                return dateString;
            },
            getCourse() {
                axios.get('http://127.0.0.1:8000/api/listClass').then(response => {
                    if (response.data && response.data.status === 200) {
                        this.data = response.data.data;
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
            },
            edit(record) {
                actions.update(true, record)
            },ok(record) {
                axios.post('http://127.0.0.1:8000/api/deleteClass', record).then(response => {
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
    .list {
        background: #ffffff;
    }
</style>
