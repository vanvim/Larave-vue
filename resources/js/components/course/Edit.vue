<template>
    <div class="wapp">
        <a-button type="primary" @click="showModal"><i class="fa fa-plus"></i> Thêm mới</a-button>
        <div class="table">
            <a-modal
                    :title="'Thêm mới khóa học'"
                    :visible="visible || isUpdate"
                    @ok="handleOk"
                    @cancel="handleCancel"
            >
                <a-form :form="form">
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Tên khóa học"
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
                            label="Thời gian học"
                    >
                        <a-input-number
                                v-decorator="[
              'date_training',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? dataUpdate.date_training : 0
              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Học phí"
                    >
                        <a-input
                                v-decorator="[
              'tuition',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? dataUpdate.tuition : ''
              },
            ]"
                        />
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
    import {store,actions} from "../../categoryStore";

    const formItemLayout = {
        labelCol: {span: 3},
        wrapperCol: {span: 20},
    };
    export default {
        data() {
            return {
                visible: false,
                formItemLayout,
                img: '',
                form: this.$form.createForm(this, {name: 'dynamic_rule'}),
            }
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
                this.clearForm();
                this.visible = true
            },onImageChange(e) {
                let file = new FileReader();

                file.readAsDataURL(e.target.files[0]);

                file.onload = (e) => {
                    this.img = e.target.result;
                }

            },
            handleOk() {
                this.form.validateFields((err, values) => {
                    if (!err) {
                        if (store.isUpdate){
                            let data = {
                                "id" : store.dataUpdate.id,
                                "name": values.name,
                                "date_training": values.date_training,
                                "tuition": values.tuition,
                                "img": this.img,

                            }
                            console.log(data)
                            axios.post('http://127.0.0.1:8000/api/editCourse', data).then(response => {
                                if (response.data.status === 200) {
                                    console.log("Thêm mới thành công")
                                    this.visible = false
                                    location.reload();
                                    this.$message.success('Thêm mới thành công');
                                    this.$notification['success']({
                                        message: 'Thêm mới thành công',
                                    });
                                }
                            }).catch(err => {
                                this.$notification['error']({
                                    message: 'Thêm mới thất bại',
                                });
                                console.log(err, 'co loi xay ra')
                            })
                        }
                        else {
                            let data = {
                                "name": values.name,
                                "date_training": values.date_training,
                                "tuition": values.tuition,
                                "img": this.img,

                            }
                            console.log(data)
                            axios.post('http://127.0.0.1:8000/api/addCourse', data).then(response => {
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