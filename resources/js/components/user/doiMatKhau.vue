<template>
    <div class="row" style="padding-top: 100px">
        <div class="col-md-8 offset-md-2">
            <!-- Register Content -->
            <div class="account-content">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7 col-lg-6 login-left">
                        <img src="assets/img/login-banner.png" class="img-fluid" alt="Doccure Register">
                    </div>
                    <div class="col-md-12 col-lg-6 login-right">
                        <div class="login-header">
                            <h3>Thay đổi mật khẩu</h3>
                        </div>
<!--                        <div class="form-group form-focus">-->
<!--                            <input v-model="pass.old" type="password" class="form-control floating">-->
<!--                            <label class="focus-label">Mật khẩu cũ</label>-->
<!--                        </div>-->
                        <div class="form-group form-focus">
                            <input v-model="pass.new" type="password" class="form-control floating">
                            <label class="focus-label">Mật khẩu mới</label>
                        </div>
                        <div class="form-group form-focus">
                            <input v-model="pass.reNew" type="password" class="form-control floating">
                            <label class="focus-label">Nhập lại mật khẩu mới</label>
                        </div>
                        <button @click.prevent="doiMatKhau" class="btn btn-primary w-100 btn-lg login-btn"
                                type="submit">Đổi mật khẩu
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import rest_api from "../../api/rest_api";
import Vue from 'vue';
import ElementUI from 'element-ui';
import {
    Icon
} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);
Vue.use(Icon);
export default {
    components: {},
    data() {
        return {
            pass: {
                old: '',
                new: '',
                reNew: ''
            },
            loading: {
                status: false,
                text: 'Loading...'
            },
        }
    },
    mounted() {
        console.log('Mounted...');
    },
    methods: {
        doiMatKhau() {
            if (!this.pass.new || this.pass.new == '') {
                this.thongBao('error','Vui lòng bổ sung đầy đủ thông tin')
                return;
            }
            if (this.pass.new.length<6 || this.pass.new.length>20) {
                this.thongBao('error','Mật khẩu từ 6-20 ký tự')
                return;
            }
            if (this.pass.new != this.pass.reNew){
                this.thongBao('error','Mật khẩu nhập lại không khớp')
                return;
            }
            rest_api.post('/doi-mat-khau', this.pass).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.thongBao('success', 'Thay đổi mật khẩu thành công.')
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
            console.log('doiMatKhau')
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
