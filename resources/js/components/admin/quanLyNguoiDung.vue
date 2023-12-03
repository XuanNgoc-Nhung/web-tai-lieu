<template>
    <el-row
        :gutter="24"
        v-loading.fullscreen.lock="loading.status" class="row">
        <el-col :span="8" style="padding-bottom: 15px;">
            <label>Từ khóa</label>
            <el-input style="width: 100%" v-model="dataSearch.key" type="text"
                      placeholder="Nhập"></el-input>
        </el-col>
        <el-col :span="6">
            <label style="color: transparent;display:block">Tìm kiếm</label>
            <el-button type="success" @click.prevent="getData()">Tìm kiếm</el-button>
        </el-col>
        <el-col :span="24">
            <div class="card">
                <div class="card-header">
                    <el-row :gutter="24">
                        <el-col :span="12"><h5 class="card-title">Người dùng</h5></el-col>
                        <el-col :span="12" class="text-right">
                            <el-button type="primary" @click.prevent="showAdd()">Thêm mới</el-button>
                        </el-col>
                    </el-row>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="datatable table-bordered table hover-table">
                            <thead class="thead-light">
                            <tr>
                                <th>STT</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Tên người dùng</th>
                                <th>Mã người dùng</th>
                                <th>Thời gian tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody v-if="list_data&&list_data.length">
                            <tr v-for="(item,index) in list_data" :key="index">
                                <td class="text-center">{{ (paging.currentPage - 1) * paging.limit + index + 1 }}</td>
                                <td><p>{{ item.email }}</p></td>
                                <td><p>{{ item.phone }}</p></td>
                                <td><p>{{ item.name }}</p></td>
                                <td><p>{{ item.ma_sv }}</p></td>
                                <td class="text-center"><p>{{ item.created_at }}</p></td>
                                <td class="text-center">
                                    <el-button size="mini" @click.prevent="showUpdate(item)" type="warning">Chỉnh sửa
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
                title="Thêm mới người dùng"
                :visible.sync="show_add"
                custom-class="minWidth375"
                width="50%"
                :before-close="handleClose">
                <div>
                    <el-row :gutter="24">
                        <el-col :xs="24" :sm="12" :md="12" :lg="12">
                            <label>Email người dùng</label>
                            <el-input style="width: 100%" v-model="dataAdd.email" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12">
                            <label>Mã người dùng</label>
                            <el-input style="width: 100%" v-model="dataAdd.ma_sv" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" class="mt-3">
                            <label>Số điện thoại người dùng</label>
                            <el-input style="width: 100%" v-model="dataAdd.phone" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" class="mt-3">
                            <label>Tên người dùng</label>
                            <el-input style="width: 100%" v-model="dataAdd.name" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                    </el-row>
                </div>
                <span slot="footer" class="dialog-footer">
    <el-button @click="show_add = false">Đóng</el-button>
    <el-button type="primary" @click="confirmAdd()">Thêm mới</el-button>
  </span>
            </el-dialog>
            <el-dialog
                title="Chỉnh sửa học phần"
                :visible.sync="show_update"
                custom-class="minWidth375"
                width="50%"
                :before-close="handleClose">
                <div>
                    <el-row :gutter="24">
                        <el-col :xs="24" :sm="12" :md="12" :lg="12">
                            <label>Email người dùng</label>
                            <el-input disabled style="width: 100%" v-model="dataUpdate.email" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12">
                            <label>Mã người dùng</label>
                            <el-input disabled style="width: 100%" v-model="dataUpdate.ma_sv" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" class="mt-3">
                            <label>Số điện thoại người dùng</label>
                            <el-input style="width: 100%" v-model="dataUpdate.phone" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" class="mt-3">
                            <label>Tên người dùng</label>
                            <el-input style="width: 100%" v-model="dataUpdate.name" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                    </el-row>
                </div>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="show_update = false">Đóng</el-button>
                    <el-button type="warning" @click="confirmUpdate()">Chỉnh sửa</el-button>
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
                key: ''
            },
            dataAdd: {
                phone: '',
                email: '',
                name: '',
                ma_sv: '',
                pass: '123456Aa@',
            },
            list_data: [],
            list_chuong_trinh_dao_tao: [],
            loading: {
                status: false,
                text: 'Loading...'
            },
            show_update: false,
            show_add: false,
            trangbatdau: false,
            paging: {
                total: 0,
                start: 0,
                limit: 10,
                currentPage: 1
            },
            dataUpdate: {
                phone: '',
                email: '',
                name: '',
                ma_sv: '',
                pass: '123456Aa@',
            }
        }
    },
    mounted() {
        console.log('Mounted Chương trình đào tạo...');
        this.getChuongTrinhDaoTao();
        this.getData();
        this.checkDanhSachYeuCau()
    },
    methods: {

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
        getTenChuongTrinhDaoTao(arr) {
            arr = arr.split(',').sort()
            let str = '';
            for (let i = 0; i < arr.length; i++) {
                for (let j = 0; j < this.list_chuong_trinh_dao_tao.length; j++) {
                    if (arr[i] == this.list_chuong_trinh_dao_tao[j].id) {
                        str += this.list_chuong_trinh_dao_tao[j].ten + '; '
                    }
                }
            }
            return str;
        },
        confirmDel(item) {
            this.$confirm('Xác nhận xoá thông tin ?', 'Thông báo', {
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
            })
                .then(_ => {
                    var url = '/admin/delete-nguoi-dung'
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
                key: this.dataSearch.key
            }
            var url = '/admin/lay-danh-sach-nguoi-dung'
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
        arrayStringToNumber(arr) {
            let arrOfNum = arr.map(str => {
                return parseInt(str, 10);
            });
            return arrOfNum
        },
        showUpdate(item) {
            console.log('showUpdate')
            this.dataUpdate = JSON.parse(JSON.stringify(item))
            this.show_update = true;
        },
        getChuongTrinhDaoTao() {
            let params = {
                start: 0,
                limit: 999999,
                key: ''
            }
            var url = '/admin/lay-danh-sach-chuong-trinh-dao-tao'
            this.loading.status = true;
            this.loading.text = 'Loading...'
            rest_api.post(url, params).then(
                response => {
                    if (response.data.rc == 0) {
                        this.list_chuong_trinh_dao_tao = response.data.data;
                    } else {
                        this.list_chuong_trinh_dao_tao = [];
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                    console.log('Chương trình đào tạo:')
                    console.log(this.list_chuong_trinh_dao_tao)
                }
            ).catch((e) => {
            })
        },
        confirmUpdate() {
            if (!this.dataUpdate.phone || this.dataUpdate.phone == '') {
                this.thongBao('error', 'Nhập số điện thoại.')
                return
            }
            if (!this.dataUpdate.name || this.dataUpdate.name == '') {
                this.thongBao('error', 'Nhập tên người dùng.')
                return
            }
            let params = {
                name: this.dataUpdate.name,
                phone: this.dataUpdate.phone,
                id: this.dataUpdate.id
            }
            rest_api.post('/admin/sua-nguoi-dung', params).then(
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
            if (!this.dataAdd.email || this.dataAdd.email == '') {
                this.thongBao('error', 'Nhập email người dùng')
                return
            }
            if (!this.dataAdd.phone || this.dataAdd.phone == '') {
                this.thongBao('error', 'Nhập số điện thoại người dùng')
                return
            }
            if (!this.dataAdd.name || this.dataAdd.name == '') {
                this.thongBao('error', 'Nhập tên người dùng.')
                return
            }
            if (!this.dataAdd.ma_sv || this.dataAdd.ma_sv == '') {
                this.thongBao('error', 'Nhập mã người dùng.')
                return
            }
            rest_api.post('/admin/them-nguoi-dung', this.dataAdd).then(
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
            this.show_update = false;
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

label {
    margin: 0
}
</style>
