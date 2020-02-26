<template>
    <div class="wapp">
        <a-button type="primary" @click="showModal"><i class="fa fa-plus"></i> Thêm mới</a-button>
        <div class="table">
            <a-modal
                    :title="'Thêm mới học viên'"
                    :visible="visible || isUpdate"
                    @ok="handleOk"
                    @cancel="handleCancel"
            >
                <a-form :form="form">
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Tên học viên"
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
                    <div>
                        <a-form-item
                                :label-col="formItemLayout.labelCol"
                                :wrapper-col="formItemLayout.wrapperCol"
                                label="Giới tính">
                            <a-radio-group
                                    :defaultValue="dataUpdate ? dataUpdate.gender : 0"
                                    @change="handleChange">
                                <a-radio :value="0">Nam</a-radio>
                                <a-radio :value="1">Nữ</a-radio>
                            </a-radio-group>
                        </a-form-item>
                    </div>
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Ngày sinh"
                    >
                        <a-date-picker
                                v-decorator="[
              'birthday',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? moment(moment(String(dataUpdate.birthday)).format('YYYY/MM/DD'), dateFormat) : moment(moment(String(20200101)).format('YYYY/MM/DD'), dateFormat)
              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Số điện thoại"
                    >
                        <a-input
                                v-decorator="[
              'phone',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? dataUpdate.phone : ''
              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Email"
                    >
                        <a-input
                                v-decorator="[
          'email',
          {
            rules: [
              {
                type: 'email',
                message: 'The input is not valid E-mail!',
              },
              {
                required: true,
                message: 'Please input your E-mail!',
              },
            ],
            initialValue: dataUpdate ? dataUpdate.email : ''
          },
        ]"
                        />
                    </a-form-item>
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Địa chỉ"
                    >
                        <a-input
                                v-decorator="[
              'address',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? dataUpdate.address : ''
              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Chuyên ngành"

                    >
                        <a-select
                                showSearch
                                placeholder="Chọn chuyên ngành"
                                style="width: 200px"
                                @change="selectedQualification"
                                :defaultValue="dataUpdate ? dataUpdate.qualification_id : 1"
                        >
                            <a-select-option v-for="qualification in qualifications" :value="qualification.id" :key="qualification.id">
                                {{ qualification.majors}}
                            </a-select-option>

                        </a-select>
                    </a-form-item>
                    <div>
                        <label>Ảnh đại diện:</label>
                        <span v-if="!img">
                        <img  v-if="isUpdate" :src="'./img/'+dataUpdate.img" alt="logo" width="200px">
                        <img v-if="!isUpdate" src="https://justice.org.au/wp-content/uploads/2017/08/avatar-icon.png" alt="logo"
                             width="200px">
                    </span>
                        <span v-if="img" >
                        <img :src="img" alt="logo" width="200px">
                    </span>
                        <input type="file" v-on:change="onImageChange"  class="form-control" name="img" enctype="multipart/form-data">
                    </div>
                </a-form>

            </a-modal>
        </div>
    </div>
</template>
<script>
    import {Button, form, Modal} from 'ant-design-vue'
    import {store, actions} from "../../categoryStore";
    import moment from "moment";
    const formItemLayout = {
        labelCol: {span: 3},
        wrapperCol: {span: 20},
    };
    export default {
        data() {
            return {
                visible: false,
                formItemLayout,
                qualifications: [],
                img: '',
                gender: 1,
                dateFormat: 'YYYY/MM/DD',
                qualificationId:1,
                form: this.$form.createForm(this, {name: 'dynamic_rule'}),
            }
        },
        mounted(){
            this.getQualification();
        },computed: {
            isUpdate() {
                return store.isUpdate
            },
            dataUpdate() {
                this.clearForm();
                console.log(store.dataUpdate)
                return store.dataUpdate
            }
        },
        methods: {
            moment,
            getDate(date) {
                var dateString = moment(String(date)).format('DD/MM/YYYY')
                return dateString;
            },
            showModal() {
                this.clearForm();
                this.visible = true;
                console.log('hihi')
            },selectedQualification(value){
                this.qualificationId = value;
            },onImageChange(e) {
                let file = new FileReader();

                file.readAsDataURL(e.target.files[0]);

                file.onload = (e) => {
                    this.img = e.target.result;
                }

            },
            handleOk(e) {
                this.form.validateFields((err, values) => {
                    if (!err) {
                        if (store.isUpdate) {
                            console.log(store.dataUpdate)
                            let data = {
                                "id": store.dataUpdate.id,
                                "name": values.name,
                                "gender": this.gender,
                                "birthday": values.birthday.format('YYYY-MM-DD'),
                                "phone": values.phone,
                                "email": values.email,
                                "address": values.address,
                                "qualifiction_id": this.qualificationId,
                                "img": this.img,
                            }
                            console.log(data)
                            axios.post('http://127.0.0.1:8000/api/editTeacher', data).then(response => {
                                if (response.data.status === 200) {
                                    console.log("Sửa")
                                    this.visible = false
                                    this.$notification['success']({
                                        message: 'Notification Title',
                                        description:
                                            'Thêm mới thành công',
                                    });
                                    this.$message.success('Sửa thành công');
                                    location.reload();
                                }
                            }).catch(err => {
                                console.log(err, 'co loi xay ra')
                            })
                        } else {
                            let data = {
                                "name": values.name,
                                "gender": this.gender,
                                "birthday": values.birthday.format('YYYY-MM-DD'),
                                "phone": values.phone,
                                "email": values.email,
                                "address": values.address,
                                "qualifiction_id": this.qualificationId,
                                "img": this.img,
                            }
                            axios.post('http://127.0.0.1:8000/api/addTeacher', data).then(response => {
                                if (response.data.status === 200) {
                                    console.log("Thêm mới thành công")
                                    this.visible = false
                                    this.$message.success('Thêm mới thành công');
                                    this.$notification['success']({
                                        message: 'Thành công',
                                        description:
                                            'Thêm mới thành công',
                                    });
                                    location.reload();
                                }
                            }).catch(err => {
                                console.log(err, 'co loi xay ra')
                            })
                        }
                    }
                })
            },handleChange(e) {
                console.log(e.target.value);
                this.gender = e.target.value;
            },
            handleCancel() {
                this.form.resetFields()
                this.visible = false;
                store.isUpdate = false
                actions.update(false, null)
            },
            getQualification() {
                axios.get('http://127.0.0.1:8000/api/listQualification').then(response => {
                    if (response.data && response.data.status === 200) {
                        this.qualifications = response.data.data;
                        console.log(this.classRoms)
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
            },clearForm() {
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