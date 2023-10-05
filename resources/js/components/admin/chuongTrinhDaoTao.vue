<template>
    <el-row
        :gutter="24"
        v-loading.fullscreen.lock="loading.status" class="row">
        <el-col :span="24">
            <div class="card">
                <div class="card-header">
                    <el-row :gutter="24">
                        <el-col :span="12">
                            <h5 class="card-title">Cấu hình</h5></el-col>
                    </el-row>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table-bordered table hover-table">
                            <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>QR</th>
                                <!--                                <th>Chuyển quỹ</th>-->
                                <!--                                <th>Nạp tiền</th>-->
                                <!--                                <th>Rút tiền</th>-->
                                <th>Thanh toán trực tuyến</th>
                                <th>Thanh toán qrcode</th>
                                <th>Thanh toán atm</th>
                                <th>Thanh toán điện tử</th>
                                <th>Thanh toán tại quầy</th>
                                <th>Thanh toán momo</th>
                                <th>Thanh toán viettelPay</th>
                            </tr>
                            </thead>
                            <tbody v-if="list_data&&list_data.length">
                            <tr v-for="(item,index) in list_data" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td class="text-center">
                                    <span style="text-align:left">Qr ngân hàng</span>
                                    <el-card shadow="always" >
                                        <img :src="item.qr_bank" alt="" style="min-width:100px;min-height:100px;max-width:150px;max-height:150px">
                                    </el-card>
                                    <span style="text-align:left">Qr momo</span>
                                    <el-card shadow="always">
                                        <img :src="item.qr_momo" alt="" style="min-width:100px;min-height:100px;max-width:150px;max-height:150px">
                                    </el-card>
                                    <el-button size="mini" type="warning" class="mt-3"
                                               @click.prevent="showUpdateQr(item)">Sửa
                                    </el-button>
                                </td>
                                <!--                                <td class="text-center">-->
                                <!--                                    <el-switch-->
                                <!--                                        @change="setStatus(item)"-->
                                <!--                                        v-model="item.chuyen_quy"-->
                                <!--                                        active-color="#13ce66"-->
                                <!--                                        inactive-color="#ff4949"-->
                                <!--                                        active-text=" "-->
                                <!--                                        inactive-text=" ">-->
                                <!--                                    </el-switch>-->
                                <!--                                </td>-->
                                <!--                                <td class="text-center">-->
                                <!--                                    <el-switch-->
                                <!--                                        @change="setStatus(item)"-->
                                <!--                                        v-model="item.nap_tien"-->
                                <!--                                        active-color="#13ce66"-->
                                <!--                                        inactive-color="#ff4949"-->
                                <!--                                        active-text=" "-->
                                <!--                                        inactive-text=" ">-->
                                <!--                                    </el-switch>-->
                                <!--                                </td>-->
                                <!--                                <td class="text-center">-->
                                <!--                                    <el-switch-->
                                <!--                                        @change="setStatus(item)"-->
                                <!--                                        v-model="item.rut_tien"-->
                                <!--                                        active-color="#13ce66"-->
                                <!--                                        inactive-color="#ff4949"-->
                                <!--                                        active-text=" "-->
                                <!--                                        inactive-text=" ">-->
                                <!--                                    </el-switch>-->
                                <!--                                </td>-->
                                <td class="text-center">
                                    <el-switch
                                        @change="setStatus(item)"
                                        v-model="item.thanh_toan_truc_tuyen"
                                        active-color="#13ce66"
                                        inactive-color="#ff4949"
                                        active-text=" "
                                        inactive-text=" ">
                                    </el-switch>
                                </td>
                                <td class="text-center">
                                    <el-switch
                                        @change="setStatus(item)"
                                        v-model="item.thanh_toan_qrcode"
                                        active-text=" "
                                        active-color="#13ce66"
                                        inactive-color="#ff4949"
                                        inactive-text=" ">
                                    </el-switch>
                                </td>
                                <td class="text-center">
                                    <el-switch
                                        @change="setStatus(item)"
                                        v-model="item.thanh_toan_atm"
                                        active-text=" "
                                        active-color="#13ce66"
                                        inactive-color="#ff4949"
                                        inactive-text=" ">
                                    </el-switch>
                                </td>
                                <td class="text-center">
                                    <el-switch
                                        @change="setStatus(item)"
                                        v-model="item.thanh_toan_dien_tu"
                                        active-text=" "
                                        active-color="#13ce66"
                                        inactive-color="#ff4949"
                                        inactive-text=" ">
                                    </el-switch>
                                </td>
                                <td class="text-center">
                                    <el-switch
                                        @change="setStatus(item)"
                                        v-model="item.thanh_toan_tai_quay"
                                        active-text=" "
                                        active-color="#13ce66"
                                        inactive-color="#ff4949"
                                        inactive-text=" ">
                                    </el-switch>
                                </td>
                                <td class="text-center">
                                    <el-switch
                                        @change="setStatus(item)"
                                        v-model="item.thanh_toan_momo"
                                        active-text=" "
                                        active-color="#13ce66"
                                        inactive-color="#ff4949"
                                        inactive-text=" ">
                                    </el-switch>
                                </td>
                                <td class="text-center">
                                    <el-switch
                                        @change="setStatus(item)"
                                        v-model="item.thanh_toan_viettel"
                                        active-text=" "
                                        active-color="#13ce66"
                                        inactive-color="#ff4949"
                                        inactive-text=" ">
                                    </el-switch>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="10" class="text-center">
                                    <p>Không có dữ liệu</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <PhanTrang v-show="paging.total>0" :tongbanghi="paging.total"
                                   :batdau="trangbatdau"
                                   @pageChange="layLai($event)">
                        </PhanTrang>
                    </div>
                </div>
            </div>
        </el-col>
    </el-row>
</template>
<script>
import rest_api from "../../api/rest_api";
import Vue from 'vue';
import ElementUI from 'element-ui';
import PhanTrang from "../Ui/phanTrang";
import {
    Icon
} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

Vue.use(ElementUI);
Vue.use(Icon);
export default {
    components: {
        PhanTrang
    },
    data() {
        return {
            list_data: [],
            loading: {
                status: false,
                text: 'Loading...'
            },
            trangbatdau: false,
            paging: {
                total: 0,
                start: 0,
                limit: 10,
                currentPage: 1
            },
        }
    },
    mounted() {
        console.log('Mounted Configs...');
    },
    methods: {
        layLai(){},
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
