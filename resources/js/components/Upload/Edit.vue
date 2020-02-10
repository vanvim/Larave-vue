<template>
    <div class="wapp">
        <a-button type="primary" @click="showModal"><i class="fa fa-plus"></i> Thêm mới</a-button>
        <div class="table">
            <a-modal
                    :title="'Upload ảnh'"
                    :visible="visible"
                    @ok="handleOk"
                    @cancel="handleCancel"
            >
                <a-form :form="form">
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
                img: '',
                form: this.$form.createForm(this, {name: 'dynamic_rule'}),
            }
        },
        methods: {
            showModal() {
                this.visible = true
            },
            onImageChange(e){
                let file = new FileReader();

                file.readAsDataURL(e.target.files[0]);

                file.onload = (e) =>{
                    this.img = e.target.result;
                }

            },
            handleOk(e) {
                let data = {
                    "img" : this.img,
                }
                axios.post('http://127.0.0.1:8000/api/addImg',data).then(response => {
                    if (response.status === 200) {
                        console.log("Thêm mới thành công")
                        this.visible = false
                        location.reload();
                        this.$message.success('Thêm mới thành công');
                    }
                }).catch(err => {
                    console.log(err, 'co loi xay ra')
                })
            },
            handleCancel() {
                this.visible = false
            },
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