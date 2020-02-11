<template>
    <div class="wapp">
        <a-button type="primary" @click="showModal"><i class="fa fa-plus"></i> Thêm mới</a-button>
        <div class="table">
            <a-modal
                    :title="'Thêm mới học viên'"
                    :visible="visible"
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

              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Giới tính">
                        <a-select default-value="Nam" v-model="gender">
                            <a-select-option value="1">
                                Nữ
                            </a-select-option>
                            <a-select-option value="0">
                                Nam
                            </a-select-option>
                        </a-select>

                    </a-form-item>
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

              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Lớp học"
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
                                placeholder="Chọn lớp học"
                                style="width: 200px"
                                @change="selectedClass"
                        >
                            <a-select-option v-for="classRom in classRoms" :value="classRom.id" :key="classRom.id">
                                {{ classRom.name}}
                            </a-select-option>

                        </a-select>
                    </a-form-item>
                    <div>
                        <label>Ảnh đại diện:</label>
                        <div>
                            <input type="file" v-on:change="onImageChange" class="form-control" name ="img">
                        </div>
                    </div>
                </a-form>

            </a-modal>
        </div>
    </div>
</template>
<script>
    import {Button, form, Modal} from 'ant-design-vue'

    const formItemLayout = {
        labelCol: {span: 3},
        wrapperCol: {span: 20},
    };
    export default {
        data() {
            return {
                visible: false,
                formItemLayout,
                classRoms: [],
                img: '',
                gender: 1,
                classId:1,
                form: this.$form.createForm(this, {name: 'dynamic_rule'}),
            }
        },
        mounted(){
        this.getClass();
    },
        methods: {
            showModal() {
                console.log('sdfghjkl')
                this.visible = true
            },selectedClass(value){
                this.classId = value;
            },
            onImageChange(e){
                let file = new FileReader();

                file.readAsDataURL(e.target.files[0]);

                file.onload = (e) =>{
                    this.img = e.target.result;
                }

            },
            handleOk(e) {
                this.form.validateFields((err, values) => {
                    if (!err) {
                        let data = {
                            "name": values.name,
                            "gender" : this.gender,
                            "birthday": values.birthday.format('YYYY-MM-DD'),
                            "phone": values.phone,
                            "email": values.email,
                            "address": values.address,
                            "class_id": this.classId,
                            "img" : this.img,
                        }
                        axios.post('http://127.0.0.1:8000/api/addStudent', data).then(response => {
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
                })
            },
            handleCancel() {
                this.visible = false
            },
            getClass() {
                axios.get('http://127.0.0.1:8000/api/listClass').then(response => {
                    if (response.data && response.data.status === 200) {
                        this.classRoms = response.data.data;
                        console.log(this.classRoms)
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
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