<template>
    <el-row
        :gutter="24"
        v-loading.fullscreen.lock="loading.status" class="row">
        <el-col :span="8" style="padding-bottom: 15px;">
            <label>Chương trình đào tạo</label>
            <el-select v-model="dataSearch.ctdt" style="width: 100%" filterable placeholder="Chọn">
                <el-option value="" label="Chọn"></el-option>
                <el-option
                    v-for="item in list_chuong_trinh_dao_tao"
                    :key="item.id"
                    :label="item.ten"
                    :value="item.id">
                </el-option>
            </el-select>
        </el-col>
        <el-col :span="6">
            <label style="color: transparent;display:block">Tìm kiếm</label>
            <el-button type="success" @click.prevent="getData()">Tìm kiếm</el-button>
        </el-col>
        <el-col :span="24">
            <div class="card">
                <div class="card-header">
                    <el-row :gutter="24">
                        <el-col :span="12"><h5 class="card-title">Học phần</h5></el-col>
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
                                <th>Chương trình đào tạo</th>
                                <th>Tên học phần</th>
                                <th>Mã học phần</th>
                                <th>Thời gian tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody v-if="list_data&&list_data.length">
                            <tr v-for="(item,index) in list_data" :key="index">
                                <td class="text-center">{{(paging.currentPage - 1) * paging.limit + index + 1}}</td>
                                <td><p>{{ getTenChuongTrinhDaoTao(item.ctdt_id) }}</p>
                                </td>
                                <td><p>{{ item.ten_mon }}</p></td>
                                <td><p>{{ item.ma_mon }}</p></td>
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
                title="Thêm mới học phần"
                :visible.sync="show_add"
                custom-class="minWidth375"
                width="50%"
                :before-close="handleClose">
                <div>
                    <el-row :gutter="24">
                        <el-col :xs="24" :sm="12" :md="12" :lg="12">
                            <label>Chương trình đào tạo</label>
                            <eselect style="width:100%" multiple collapseTags v-model="dataAdd.ctdt"
                                     :placeholder="'Chọn'" filterable
                                     :data="list_chuong_trinh_dao_tao" :fields="['ten','id']"/>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12">
                            <label>Mã học phần</label>
                            <el-input style="width: 100%" v-model="dataAdd.ma_mon" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" class="mt-3">
                            <label>Tên học phần</label>
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
                            <label>Chương trình đào tạo</label>
                            <eselect style="width:100%" multiple collapseTags v-model="dataUpdate.ctdt_id"
                                     :placeholder="'Chọn'" filterable
                                     :data="list_chuong_trinh_dao_tao" :fields="['ten','id']"/>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12">
                            <label>Mã học phần</label>
                            <el-input style="width: 100%" v-model="dataUpdate.ma_mon" type="text"
                                      placeholder="Nhập"></el-input>
                        </el-col>
                        <el-col :xs="24" :sm="12" :md="12" :lg="12" class="mt-3">
                            <label>Tên học phần</label>
                            <el-input style="width: 100%" v-model="dataUpdate.ten_mon" type="text"
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
                ctdt: ''
            },
            dataAdd: {
                ctdt: '',
                name: '',
                ma_mon:''
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
                ctdt_id: [],
                name: '',
                ma_mon:''
            }
        }
    },
    mounted() {
        console.log('Mounted Chương trình đào tạo...');
        this.getChuongTrinhDaoTao();
        this.getData();
        this.checkDanhSachYeuCau();
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
                    var url = '/admin/delete-mon-hoc'
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
                ctdt: this.dataSearch.ctdt
            }
            var url = '/admin/lay-danh-sach-mon-hoc'
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
            this.dataUpdate.ctdt_id = this.arrayStringToNumber(item.ctdt_id.split(','))
            console.log(this.dataUpdate.ctdt_id)
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
            if (!this.dataUpdate.ctdt_id || this.dataUpdate.ctdt_id == '') {
                this.thongBao('error', 'Chọn chương trình đào tạo.')
                return
            }
            if (!this.dataUpdate.ten_mon || this.dataUpdate.ten_mon == '') {
                this.thongBao('error', 'Nhập tên học phần.')
                return
            }
            if (!this.dataUpdate.ma_mon || this.dataUpdate.ma_mon == '') {
                this.thongBao('error', 'Nhập tên học phần.')
                return
            }
            let params = {
                ctdt_id: this.dataUpdate.ctdt_id.toString(),
                ten_mon: this.dataUpdate.ten_mon,
                ma_mon: this.dataUpdate.ma_mon,
                id: this.dataUpdate.id
            }
            rest_api.post('/admin/sua-mon-hoc', params).then(
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
            if (!this.dataAdd.ctdt || this.dataAdd.ctdt == '') {
                this.thongBao('error', 'Chọn chương trình đào tạo.')
                return
            }
            if (!this.dataAdd.name || this.dataAdd.name == '') {
                this.thongBao('error', 'Nhập tên học phần.')
                return
            }
            if (!this.dataAdd.ma_mon || this.dataAdd.ma_mon == '') {
                this.thongBao('error', 'Nhập mã học phần.')
                return
            }
            let params = {
                ten: this.dataAdd.name,
                ma_mon: this.dataAdd.ma_mon,
                ctdt: this.dataAdd.ctdt.toString()
            }

            rest_api.post('/admin/them-mon-hoc', params).then(
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
label{
    margin:0
}
</style>
