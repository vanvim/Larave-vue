<template>
    <div class="wapp">
        <a-button type="primary" @click="showModal">Tạo mới</a-button>
        <div class ="table">
            <a-modal
                    :title="'Tạo mới'"
                    :visible="visible"
                    @ok="handleOk"
                    @cancel="handleCancel"
            >
                <a-form :form="form">
                    <a-form-item
                            :label-col="formItemLayout.labelCol"
                            :wrapper-col="formItemLayout.wrapperCol"
                            label="Tên học viên ">
                        <a-select
                                showSearch
                                placeholder="Chọn lớp học"
                                style="width: 200px"
                                @change="selectedClass"
                                :defaultValue="dataUpdate ? dataUpdate.class_id : 1"
                        >
                            <a-select-option v-for="classRom in classRoms" :value="classRom.id" :key="classRom.id">
                                {{ classRom.name}}
                            </a-select-option>

                        </a-select>
                    </a-form-item>

                </a-form>

            </a-modal>
        </div>
    </div>
</template>
<script>
    import { Button,form,Modal } from 'ant-design-vue'
    const formItemLayout = {
        labelCol: {span: 4},
        wrapperCol: {span: 20},
    };
    export default {
        data() {
            return {
                visible : false,
                formItemLayout,
                form: this.$form.createForm(this, {name: 'dynamic_rule'}),
            }
        },
        methods:{
            showModal(){
                console.log('sdfghjkl')
                this.visible = true
            },
            handleOk(){
                this.visible = false
            },
            handleCancel(){
                this.visible = false
            }
        }
    }
</script>
<style lang="scss">
    .table{
        margin: 20px;
    }
    .wapp{
        padding :20px;
    }
</style>