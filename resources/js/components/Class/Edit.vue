<template>
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
                                    this.$notification['success']({
                                        message: 'Sửa thành công',
                                    });
                                    this.$message.success('Sửa thành công');
                                    location.reload();
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
                                    this.$notification['success']({
                                        message: 'Notification Title',
                                        description:
                                            'Thêm mới thành công',
                                    });
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
                    if (response.data && response.data.status === 200) {
                        this.Courses = response.data.data;
                        console.log(this.Courses)
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
            },clearForm(){
                this.form.resetFields();
            }
        }
    }
</script>
<style lang="scss">
    .table {
        margin: 20px;
    }

    .wapp {
        padding: 20px;
    }
</style>
