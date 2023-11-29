<template>
    <el-row :gutter="24">
        <el-col :span="24" class="mt-5">
            <div class="text-center">
                <el-button type="success"> Về trang chủ</el-button>
                <el-button type="primary" @click.prevent="show_add = true"> Thêm yêu cầu</el-button>
            </div>
            <div>
                <el-dialog
                    top="5vh"
                    title="Thêm Yêu Cầu"
                    :visible.sync="show_add"
                    custom-class="minWidth375"
                    :before-close="handleClose">
                    <div>
                        <el-row :gutter="24">
                            <el-col :span="24" class="text-left">
                                <label>Tiêu đề <span class="required" style="color: red">*</span></label>
                                <el-input type="text" placeholder="Nhập" clearable
                                          v-model="dataYeuCau.tieu_de"></el-input>
                            </el-col>
                            <el-col :span="24" class="text-left mt-3">
                                <label>Nội dung <span class="required" style="color: red;text-align: left">*</span></label>
                                <vue-editor v-model="dataYeuCau.noi_dung"/>
                            </el-col>
                        </el-row>
                    </div>
                    <span slot="footer" class="dialog-footer">
    <el-button @click="show_add = false">Đóng</el-button>
    <el-button type="warning" @click="xacNhanThemMoi()">Thêm mới</el-button>
  </span>
                </el-dialog>
            </div>
        </el-col>
    </el-row>
</template>

<script>
import rest_api from "../../api/rest_api";
import Vue from 'vue';
import ElementUI from 'element-ui';
import Vue2Editor from "vue2-editor";
import {
    Icon
} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import eselect from "../Ui/ESelect.vue";

Vue.use(ElementUI);
Vue.use(Vue2Editor);
Vue.use(Icon);
export default {
    components: {eselect},
    data() {
        return {
            show_add: false,
            loading: {
                status: false,
                text: 'Loading...'
            },
            dataYeuCau: {
                tieu_de: '',
                noi_dung: ''
            }
        }
    },
    mounted() {
        console.log('Mounted...');
    },
    methods: {
        xacNhanThemMoi() {
            console.log('Xác nhận thêm mới')
            if(!this.dataYeuCau.tieu_de||this.dataYeuCau.tieu_de==''||!this.dataYeuCau.noi_dung||this.dataYeuCau.noi_dung==''){
                this.thongBao('error','Vui lòng bổ sung thông tin.')
                return;
            }
            var url = '/them-yeu-cau'
            this.loading.status = true;
            this.loading.text = 'Loading...'
            rest_api.post(url, this.dataYeuCau).then(
                response => {
                    if (response.data.rc == 0) {
                        this.thongBao('success','Thêm yêu cầu thành công')
                        setTimeout(()=>{
                            window.location.reload(true);
                        },1500)
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        handleClose() {
            this.show_add = false
        },
        thongBao(typeNoty, msgNoty) {
            let msg = "";
            let cl = "";
            if (msgNoty) {
                msg = msgNoty;
            }
            let type = "success";
            if (typeNoty) {
                type = typeNoty
            }
            if (type == "success") {
                cl = "dts-noty-success"
            }
            if (type == "warning") {
                cl = "dts-noty-warning"
            }
            if (type == "error") {
                cl = "dts-noty-error"
            }
            if (type == "info") {
                cl = "dts-noty-info"
            }
            this.$message({
                customClass: cl,
                showClose: true,
                message: msg,
                type: type,
                duration: 3000
            });
        },
    }
}

</script>
<style scoped="scoped">
th {
    text-align: center;
}
</style>
