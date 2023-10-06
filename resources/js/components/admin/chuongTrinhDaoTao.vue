<template>
    <el-row
        :gutter="24"
        v-loading.fullscreen.lock="loading.status" class="row">
        <el-col :span="24">
            <div class="card">
                <div class="card-header">
                    <el-row :gutter="24">
                        <el-col :span="12"><h5 class="card-title">Chương trình đào tạo</h5></el-col>
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
                                <th>Tên chương trình</th>
                                <th>Thời gian tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody v-if="list_data&&list_data.length">
                            <tr v-for="(item,index) in list_data" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td><p>{{ item.ten }}</p></td>
                                <td class="text-center"><p>{{ item.created_at }}</p></td>
                                <td class="text-center">
                                    <el-button size="mini" @click.prevent="showUpdate(item)" type="warning">Chỉnh sửa
                                    </el-button>
                                    <el-button size="mini" type="danger">Xóa</el-button>
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
                title="Thêm mới chương trình đào tạo"
                :visible.sync="show_add"
                custom-class="minWidth375"
                width="50%"
                :before-close="handleClose">
                <div>
                    <el-row :gutter="24">
                        <el-col :span="24">
                            <label>Tên chương trình đào tạo</label>
                            <el-input v-model="dataAdd.ten" type="text" placeholder="Nhập"></el-input>
                        </el-col>
                    </el-row>
                </div>
                <span slot="footer" class="dialog-footer">
    <el-button @click="show_add = false">Đóng</el-button>
    <el-button type="primary" @click="confirmAdd()">Thêm mới</el-button>
  </span>
            </el-dialog>
            <el-dialog
                title="Chỉnh sửa chương trình đào tạo"
                :visible.sync="show_update"
                custom-class="minWidth375"
                width="50%"
                :before-close="handleClose">
                <div>
                    <el-row :gutter="24">
                        <el-col :span="24">
                            <label>Tên chương trình đào tạo</label>
                            <el-input v-model="dataUpdate.ten" type="text" placeholder="Nhập"></el-input>
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
            show_update: false,
            show_add: false,
            trangbatdau: false,
            paging: {
                total: 0,
                start: 0,
                limit: 10,
                currentPage: 1
            },
            dataAdd: {
                ten: ''
            },
            dataUpdate: {}
        }
    },
    mounted() {
        console.log('Mounted Chương trình đào tạo...');
        this.getData();
    },
    methods: {
        showUpdate(item) {
            this.dataUpdate = JSON.parse(JSON.stringify(item))
            this.show_update = true;
        },
        getData() {
            this.handleClose();
            let params = {
                start: this.paging.start,
                limit: this.paging.limit,
                key: ''
            }
            var url = '/admin/lay-danh-sach-chuong-trinh-dao-tao'
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
        confirmUpdate(){
            let params = {
                ten: this.dataUpdate.ten,
                id:this.dataUpdate.id
            }
            rest_api.post('/admin/sua-chuong-trinh-dao-tao', params).then(
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
            let params = {
                ten: this.dataAdd.ten
            }
            rest_api.post('/admin/them-chuong-trinh-dao-tao', params).then(
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
        layLai() {
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
