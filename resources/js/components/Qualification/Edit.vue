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
                            label="Tên chuyên ngành"
                    >
                        <a-input
                                v-decorator="[
              'majors',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? dataUpdate.majors : ''
              },
            ]"
                        />
                    </a-form-item>
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Đơn vị cấp"
                    >
                        <a-input
                                v-decorator="[
              'competent_units',
              {
              rules: [{
                required: true,
                message: 'Bạn phải nhập trường này'
                }],
                initialValue: dataUpdate ? dataUpdate.competent_units : ''
              },
            ]"
                        />
                    </a-form-item>

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
            },
            handleOk() {
                this.form.validateFields((err, values) => {
                    if (!err) {
                        if (store.isUpdate){
                            let data = {
                                "id" : store.dataUpdate.id,
                                "majors": values.majors,
                                "competent_units": values.competent_units
                            }
                            console.log(data)
                            axios.post('http://127.0.0.1:8000/api/editQualification',data).then(response => {
                                if (response.data.status === 200) {
                                    console.log("Sửa thành công")
                                    this.visible = false
                                    location.reload();
                                    this.$message.success('Sửa thành công');
                                }
                            }).catch(err => {
                                console.log(err, 'co loi xay ra')
                            })
                        } else {
                            let data = {
                                "majors": values.majors,
                                "competent_units": values.competent_units
                            }
                            console.log(data)
                            axios.post('http://127.0.0.1:8000/api/addQualification',data).then(response => {
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
            clearForm(){
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