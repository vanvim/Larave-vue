<template>
<<<<<<< HEAD
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
=======
    <div class="wapp">
        <a-button type="primary" @click="showModal">Tạo mới</a-button>
        <div class="table">
            <a-modal
                :title="'Tạo mới'"
                :visible="visible || isUpdate"
                @ok="handleOk"
                @cancel="handleCancel"
            >
                <a-form :form="form">
                    <a-form-item
                        :label-col="formItemLayout.labelCol"
                        :wrapper-col="formItemLayout.wrapperCol"
                        label="Tên lớp"
                    >
                        <a-input
                            v-decorator="[
              'name',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? dataUpdate.name : ''
              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                        :label-col="formItemLayout.labelCol"
                        :wrapper-col="formItemLayout.wrapperCol"
                        label="Sĩ số"
                    >
                        <a-input-number
                            v-decorator="[
              'number',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? dataUpdate.number : ''
              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                        :label-col="formItemLayout.labelCol"
                        :wrapper-col="formItemLayout.wrapperCol"
                        label="Ngày bắt đầu"
                    >
                        <a-date-picker
                            v-decorator="[
              'start_time',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? moment(moment(String(dataUpdate.start_time)).format('YYYY/MM/DD'), dateFormat) : moment(moment(String(20200101)).format('YYYY/MM/DD'), dateFormat)
              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                        :label-col="formItemLayout.labelCol"
                        :wrapper-col="formItemLayout.wrapperCol"
                        label="Lịch học"
                    >
                        <a-input
                            v-decorator="[
              'schedule',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? dataUpdate.schedule : ''
              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                        :label-col="formItemLayout.labelCol"
                        :wrapper-col="formItemLayout.wrapperCol"
                        label="Giáo viên"
                        v-decorator="[
              'class',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
              },
            ]"
                    >
                        <a-select
                            showSearch
                            placeholder="Chọn Giáo viên"
                            style="width: 200px"
                            @change="selectedTeacher"
                            :defaultValue="dataUpdate ? dataUpdate.teacher_id : 1"
                        >
                            <a-select-option v-for="Teacher in Teachers" :value="Teacher.id" :key="Teacher.id">
                                {{ Teacher.name}}
                            </a-select-option>

                        </a-select>
                    </a-form-item>
                    <a-form-item
                        :label-col="formItemLayout.labelCol"
                        :wrapper-col="formItemLayout.wrapperCol"
                        label="Khóa học"
                        v-decorator="[
              'class',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }]
              },
            ]"
                    >
                        <a-select
                            showSearch
                            placeholder="Chọn khóa học"
                            style="width: 200px"
                            @change="selectedCourse"
                            :defaultValue="dataUpdate ? dataUpdate.course_id : 1"
                        >
                            <a-select-option v-for="Course in Courses" :value="Course.id" :key="Course.id">
                                {{ Course.name}}
                            </a-select-option>

                        </a-select>
                    </a-form-item>
                </a-form>

            </a-modal>
        </div>
    </div>
</template>
<script>
    import {Button, form, Modal} from 'ant-design-vue'
    import {store,actions} from "../../categoryStore";
    import moment from "moment";
    const formItemLayout = {
        labelCol: {span: 6},
        wrapperCol: {span: 15},
    };
    export default {
        data() {
            return {
                visible: false,
                formItemLayout,
                Teachers: [],
                Courses: [],
                CourseId: 1,
                TeacherId: 1,
                dateFormat: 'YYYY/MM/DD',
                form: this.$form.createForm(this, {name: 'dynamic_rule'}),
            }
        },
        created() {
            this.getTeacher();
            this.getCourse();
        },
        computed: {
            isUpdate() {
                return store.isUpdate
            },
            dataUpdate() {
                this.clearForm();
                return store.dataUpdate
            }
        },
        methods: {
            showModal() {
                this.visible = true
                this.clearForm();
            },
            selectedTeacher(value) {
                this.TeacherId = value;
            }, selectedCourse(value) {
                this.CourseId = value;
            },
            moment,
            getDate(date) {
                var dateString = moment(String(date)).format('DD/MM/YYYY')
                return  dateString;
            },
            handleOk() {
                this.form.validateFields((err, values) => {
                    if (!err) {
                        if (store.isUpdate){
                            let data = {
                                "id" : store.dataUpdate.id,
                                "name": values.name,
                                "number": values.number,
                                "start_time": Number(values.start_time.format('YYYYMMDD')),
                                "teacher_id": this.TeacherId,
                                "course_id": this.CourseId,
                                "schedule": values.schedule,
                            }
                            console.log(data)
                            axios.post('http://127.0.0.1:8000/api/editClass', data).then(response => {
                                if (response.data.status === 200) {
                                    console.log("Sửa thành công")
                                    this.visible = false
                                    location.reload();
                                    this.$message.success('Sửa thành công');
                                }
                            }).catch(err => {
                                console.log(err, 'co loi xay ra')
                            })
                        }else {
                            let data = {
                                "name": values.name,
                                "number": values.number,
                                "start_time": Number(values.start_time.format('YYYYMMDD')),
                                "teacher_id": this.TeacherId,
                                "course_id": this.CourseId,
                                "schedule": values.schedule,
                            }
                            axios.post('http://127.0.0.1:8000/api/addClass', data).then(response => {
                                if (response.data.status === 200) {
                                    console.log("Thêm mới thành công")
                                    this.visible = false
                                    location.reload();
                                    this.$message.success('Thêm mới thành công');
                                }
                            }).catch(err => {
                                console.log(err, 'co loi xay ra')
                            })
                        }
                    }
                })
            },
            handleCancel() {
                this.form.resetFields()
                this.visible = false;
                store.isUpdate = false
                actions.update(false, null)
            },
            getTeacher() {
                axios.get('http://127.0.0.1:8000/api/listTeacher').then(response => {
                    if (response.data && response.data.status === 200) {
                        this.Teachers = response.data.data;
                        console.log(this.Teachers)
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
            }, getCourse() {
                axios.get('http://127.0.0.1:8000/api/listCourse').then(response => {
>>>>>>> develop
                    if (response.data && response.data.status === 200) {
                        this.data = response.data.data;
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
<<<<<<< HEAD
            },
            edit(record) {
                actions.update(true, record)
=======
            },clearForm(){
                this.form.resetFields();
>>>>>>> develop
            }
        }
    }
</script>
<<<<<<< HEAD
<style lang="scss" scoped>
    .list {
        background: #ffffff;
=======
<style lang="scss">
    .table {
        margin: 20px;
    }

    .wapp {
        padding: 20px;
>>>>>>> develop
    }
</style>
