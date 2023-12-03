<template>
    <el-row
        :gutter="24"
        v-loading.fullscreen.lock="loading.status" class="row">
        <el-col :span="6" style="padding-bottom: 15px;">
            <label>Tiêu đề yêu cầu</label>
            <el-input v-model="dataSearch.tieu_de" placeholder="Nhập" clearable></el-input>
        </el-col>
        <el-col :span="6">
            <label style="color: transparent;display:block">Tìm kiếm</label>
            <el-button type="success" @click.prevent="getData()">Tìm kiếm</el-button>
        </el-col>
        <el-col :span="24">
            <div class="card">
                <div class="card-header">
                    <el-row :gutter="24">
                        <el-col :span="12"><h5 class="card-title">Yêu cầu</h5></el-col>
<!--                        <el-col :span="12" class="text-right">-->
<!--                            <el-button type="primary" @click.prevent="showAdd()">Thêm mới</el-button>-->
<!--                        </el-col>-->
                    </el-row>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table-bordered table hover-table">
                            <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Người tạo</th>
                                <th>Email</th>
                                <th>Tiêu đề</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody v-if="list_data&&list_data.length">
                            <tr v-for="(item,index) in list_data" :key="index">
                                <td class="text-center">{{(paging.currentPage - 1) * paging.limit + index + 1}}</td>
                                <td><p>{{ item.nguoi_tao?item.nguoi_tao.name:'[Không xác định]'}}</p></td>
                                <td><p>{{ item.nguoi_tao?item.nguoi_tao.email:'[Không xác định]'}}</p></td>
                                <td><p>{{ item.tieu_de }}</p></td>
                                <td>
                                    <p>{{item.trang_thai==0?'Chưa xem':'Đã xem'}}</p>
                                </td>
                                <td class="text-center"><p>{{ item.created_at }}</p></td>
                                <td class="text-center">
                                    <el-button size="mini" @click.prevent="xemYeuCau(item)" type="primary">Xem
                                    </el-button>
                                    <el-button size="mini" @click.prevent="showUpdate(item)" type="warning">Trả lời
                                    </el-button>
                                    <el-button size="mini" @click.prevent="confirmDel(item)" type="danger">Xóa
                                    </el-button>
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
        <el-col :span="24">
            <el-dialog
                title="Thêm mới thông báo"
                :visible.sync="show_add"
                custom-class="minWidth375"
                fullscreen
                :before-close="handleClose">
                <div>
                    <el-row :gutter="24">
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" :xl="12">
                            <label>Tên tài liệu</label>
                            <el-input type="text" placeholder="Nhập" clearable
                                      v-model="dataAdd.tieu_de"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" :xl="12">
                            <label>Mô tả </label>
                            <el-input type="text" placeholder="Nhập" clearable
                                      v-model="dataAdd.mo_ta"></el-input>
                        </el-col>
                        <el-col :span="24">
                            <label>Nội dung</label>
                            <vue-editor v-model="dataAdd.noi_dung"/>
                        </el-col>
                    </el-row>
                </div>
                <span slot="footer" class="dialog-footer">
    <el-button @click="show_add = false">Đóng</el-button>
    <el-button type="primary" @click="confirmAdd()">Thêm mới</el-button>
  </span>
            </el-dialog>
            <el-dialog
                :title="thongTinXem.tieu_de"
                :visible.sync="xem_yeu_cau"
                top="10vh"
                custom-class="minWidth375"
                :before-close="handleClose">
                <div>
                    <el-row :gutter="24">
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" :xl="12">
                            <label>Người yêu cầu</label>
                            <el-input type="text" placeholder="Nhập" clearable
                                      disabled
                                      :value="thongTinXem.nguoi_tao?thongTinXem.nguoi_tao.name:'[Không xác định]'"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" :xl="12">
                            <label>Email </label>
                            <el-input type="text" placeholder="Nhập" clearable
                                      disabled
                                      :value="thongTinXem.nguoi_tao?thongTinXem.nguoi_tao.email:'[Không xác định]'"></el-input>
                        </el-col>
                        <el-col :span="24">
                            <label>Nội dung</label>
<!--                            <vue-editor v-model="thongTinXem.noi_dung"/>-->
                            <el-card class="box-card">
                                <div v-html="thongTinXem.noi_dung"></div>
                            </el-card>
                        </el-col>
                    </el-row>
                </div>
                <span slot="footer" class="dialog-footer">
    <el-button @click="xem_yeu_cau = false">Đóng</el-button>
  </span>
            </el-dialog>
        </el-col>
    </el-row>
</template>
<script>
import rest_api from "../../api/rest_api";
import Vue from 'vue';
import ESelectVue from '../Ui/ESelect.vue';
import ElementUI from 'element-ui';
import PhanTrang from "../Ui/phanTrang";
import {
    Icon
} from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

import Vue2Editor from "vue2-editor";

Vue.use(Vue2Editor);
Vue.use(ElementUI);
Vue.use(Icon);
export default {
    components: {
        PhanTrang,
        'eselect': ESelectVue,
    },
    data() {
        return {
            dataSearch: {
                tieu_de: ''
            },
            dataAdd: {
                tieu_de: '',
                mo_ta: '',
                noi_dung: '',
            },
            list_data: [],
            loading: {
                status: false,
                text: 'Loading...'
            },
            xem_yeu_cau: false,
            show_add: false,
            trangbatdau: false,
            paging: {
                total: 0,
                start: 0,
                limit: 10,
                currentPage: 1
            },
            dataUpdate: {},
            thongTinXem:{},
        }
    },
    mounted() {
        console.log('Mounted Chương trình đào tạo...');
        this.getData();
        this.checkDanhSachYeuCau();
    },
    methods: {
        confirmDel(item) {
            this.$confirm('Xác nhận xoá thông tin ?', 'Thông báo', {
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
            })
                .then(_ => {
                    var url = '/admin/delete-yeu-cau'
                    this.loading.status = true;
                    this.loading.text = 'Loading...'
                    rest_api.post(url, {id: item.id}).then(
                        response => {
                            if (response.data.rc == 0) {
                                this.getData()
                                this.thongBao('success', 'Xoá dữ liệu thành công')
                            } else {
                                this.thongBao('error', response.data.rd)
                            }
                            this.loading.status = false;
                        }
                    ).catch((e) => {
                    })
                })
                .catch(_ => {
                });
        },
        getData() {
            this.handleClose();
            let params = {
                start: this.paging.start,
                limit: this.paging.limit,
                key: this.dataSearch.tieu_de
            }
            var url = '/admin/lay-danh-sach-yeu-cau'
            this.loading.status = true;
            this.loading.text = 'Loading...'
            rest_api.post(url, params).then(
                response => {
                    if (response.data.rc == 0) {
                        this.list_data = response.data.data;
                        this.paging.total = response.data.total
                    } else {
                        this.list_data = [];
                        this.paging.total = 0;
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        checkDanhSachYeuCau(){
            rest_api.post('/admin/check-danh-sach-yeu-cau', {}).then(
                response => {
                    if (response && response.data.rc == 0){
                        // this.thongBao('warning', response.data.rd)
                    } else {
                        this.thongBao('warning', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },

        xemYeuCau(item){
            this.thongTinXem = item;
            this.xem_yeu_cau = true;
            rest_api.post('/admin/danh-dau-yeu-cau-da-xem', {id:this.thongTinXem.id}).then(
                response => {
                    if (response && response.data.rc == 0) {
                    } else {
                        // this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        showUpdate(item) {
            this.thongBao('warning','Vui lòng phản hồi qua email của người dùng');
            return;
            this.dataUpdate = JSON.parse(JSON.stringify(item))
            console.log('data update:')
            console.log(this.dataUpdate)
            this.xem_yeu_cau = true;
        },
        arrayStringToNumber(arr) {
            let arrOfNum = arr.map(str => {
                return parseInt(str, 10);
            });
            return arrOfNum
        },
        confirmUpdate() {
            console.log('confirmUpdate')
            rest_api.post('/admin/sua-thong-bao', this.dataUpdate).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.handleClose();
                        this.getData()
                        this.thongBao('success', 'Thành công')
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        confirmAdd() {
            if (this.dataAdd.tieu_de == '' || this.dataAdd.mo_ta == '' || this.dataAdd.noi_dung == '') {
                this.thongBao('error', 'Vui lòng điền đầy đủ thông tin.')
                return
            }
            rest_api.post('/admin/them-thong-bao', this.dataAdd).then(
                response => {
                    if (response && response.data.rc == 0) {
                        this.handleClose();
                        this.getData()
                        this.thongBao('success', 'Thành công')
                    } else {
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
        },
        showAdd() {
            this.show_add = true;
        },
        handleClose() {
            this.show_add = false;
            this.xem_yeu_cau = false;
        },
        layLai(e) {
            this.paging.start = e.start;
            this.paging.limit = e.limit;
            this.paging.currentPage = e.currentPage;
            this.getData()
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

.el-col {
    padding-top: 15px;
}

.el-col label {
    margin-bottom: 0;
}
</style>
