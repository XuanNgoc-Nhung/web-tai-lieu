<template>
    <el-row
        :gutter="24"
        v-loading.fullscreen.lock="loading.status" class="row">
        <el-col :span="6" style="padding-bottom: 15px;">
            <label>Tên tài liệu</label>
            <el-input v-model="dataSearch.ten_tai_lieu" placeholder="Nhập tên tài liệu" clearable></el-input>
        </el-col>
        <el-col :span="6">
            <label style="color: transparent;display:block">Tìm kiếm</label>
            <el-button type="success" @click.prevent="getData()">Tìm kiếm</el-button>
        </el-col>
        <el-col :span="24">
            <div class="card">
                <div class="card-header">
                    <el-row :gutter="24">
                        <el-col :span="12"><h5 class="card-title">Tài liệu</h5></el-col>
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
                                <th>Tên tài liệu</th>
                                <th>Môn học chính</th>
                                <th>Môn học phụ</th>
                                <th>Mô tả</th>
                                <th>Nội dung</th>
                                <th>Tác giả</th>
                                <th>Thẻ</th>
                                <th>Lượt xem</th>
                                <th>File tài liệu</th>
                                <th>Ảnh bìa</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody v-if="list_data&&list_data.length">
                            <tr v-for="(item,index) in list_data" :key="index">
                                <td class="text-center">{{ index + 1 }}</td>
                                <td><p>{{ item.ten_tai_lieu }}</p></td>
                                <td>
                                    <p>{{ item.mon_hoc_chinh ? item.mon_hoc_chinh.ten_mon : 'Trống' }}</p>
                                </td>
                                <td><p v-if="item.mon_hoc_phu">{{ getTenMonHoc(item.mon_hoc_phu) }}</p>
                                </td>
                                <td><p>{{ item.mo_ta }}</p></td>
                                <td>
                                    <div v-html="item.noi_dung"></div>
                                </td>
                                <td><p>{{ item.tac_gia }}</p></td>
                                <td><p>{{ item.tag }}</p></td>
                                <td class="text-center"><p>{{ item.luot_xem }}</p></td>
                                <td>
                                    <a :href="item.link_file" target="_blank">{{ item.link_file }}</a>
                                    <!--                                    <el-button size="mini" @click.prevent="clickFile(item.link_file)" type="primary">-->
                                    <!--                                        Xem/Tải xuống-->
                                    <!--                                    </el-button>-->
                                </td>
                                <td class="text-center">
                                    <el-card shadow="always">
                                        <img :src="item.hinh_anh" alt="" style="width: 100px;height: 150px">
                                    </el-card>
                                </td>
                                <td class="text-center"><p>{{ item.created_at }}</p></td>
                                <td class="text-center">
                                    <el-button size="mini" @click.prevent="showUpdate(item)" type="warning">Chỉnh
                                        sửa
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
                title="Thêm mới tài liệu"
                :visible.sync="show_add"
                custom-class="minWidth375"
                fullscreen
                :before-close="handleClose">
                <div>
                    <el-row :gutter="24">
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Chương trình đào tạo</label>

                            <eselect style="width:100%" @change="chonChuongTrinhDaoTao" collapseTags
                                     v-model="dataAdd.ctdt"
                                     :placeholder="'Chọn'" filterable
                                     :data="list_chuong_trinh_dao_tao" :fields="['ten','id']"/>
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Áp dụng làm tài liệu chính cho môn</label>
                            <el-select v-model="dataAdd.mon_hoc_chinh" style="width: 100%" filterable
                                       placeholder="Chọn">
                                <el-option
                                    v-for="item in list_mon_hoc"
                                    :key="item.id"
                                    :label="item.ten_mon"
                                    :value="item.id">
                                </el-option>
                            </el-select>
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Áp dụng làm tài liệu phụ cho môn</label>

                            <eselect style="width:100%" multiple collapseTags v-model="dataAdd.mon_hoc_phu"
                                     :placeholder="'Chọn'" filterable
                                     :data="list_mon_hoc" :fields="['ten_mon','id']"/>
                            <!--                            <el-select v-model="dataAdd.mon_hoc_phu" style="width: 100%" filterable placeholder="Chọn">-->
                            <!--                                <el-option-->
                            <!--                                    v-for="item in list_mon_hoc"-->
                            <!--                                    :key="item.id"-->
                            <!--                                    :label="item.ten_mon"-->
                            <!--                                    :value="item.id">-->
                            <!--                                </el-option>-->
                            <!--                            </el-select>-->
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Tên tài liệu</label>
                            <el-input type="text" placeholder="Nhập" clearable
                                      v-model="dataAdd.ten_tai_lieu"></el-input>
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Mô tả </label>
                            <el-input type="text" placeholder="Nhập" clearable
                                      v-model="dataAdd.mo_ta"></el-input>
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Tác giả </label>
                            <el-select
                                no-match-text="Không tìm thấy"
                                no-data-text="Nhập nội dung sau đó nhấn enter"
                                v-model="dataAdd.tac_gia"
                                multiple
                                filterable
                                style="width:100%"
                                allow-create
                                default-first-option
                                placeholder="Nhập">
                                <el-option
                                    v-for="item in []"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                                </el-option>
                            </el-select>
                        </el-col>
                        <el-col :xs="12" :sm="24" :md="6" :lg="6" :xl="6">
                            <label>Loại tài liệu</label>
                            <el-select v-model="dataAdd.loai" style="width: 100%" filterable placeholder="Chọn">
                                <el-option
                                    v-for="item in ds_loai_tai_lieu"
                                    :key="item.value"
                                    :label="item.name"
                                    :value="item.value">
                                </el-option>
                            </el-select>
                        </el-col>
                        <el-col :xs="12" :sm="24" :md="6" :lg="6" :xl="6">
                            <label>Thẻ</label>
                            <el-select
                                no-match-text="Không tìm thấy"
                                no-data-text="Nhập nội dung sau đó nhấn enter"
                                v-model="dataAdd.tag"
                                multiple
                                filterable
                                style="width:100%"
                                allow-create
                                default-first-option
                                placeholder="Nhập">
                                <el-option
                                    v-for="item in []"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                                </el-option>
                            </el-select>
                        </el-col>
                        <el-col v-if="file_tai_lieu" :span="6">
                            <label>Tài liệu đã chọn</label>
                            <div class="source d-flex">
                                <ul class="el-upload-list el-upload-list--picture-card " style="display: contents">
                                    <li style="width: 100%; margin: 0"
                                        tabindex="0"
                                        class="el-upload-list__item is-ready"
                                    >
                                        <el-alert
                                            :title="file_tai_lieu.name"
                                            type="success"
                                            effect="dark">
                                        </el-alert>
                                    </li>
                                </ul>

                            </div>
                        </el-col>
                        <el-col :span="6">
                            <label>Tài liệu</label>
                            <div class="source d-flex">
                                <ul class="el-upload-list el-upload-list--picture-card " style="display: contents">
                                    <li>
                                        <el-upload
                                            ref="uploadShop"
                                            :show-file-list="false"
                                            :on-change="uploadFileTaiLieu"
                                            accept=".docx,.doc,.pdf"
                                            action="/"
                                            :auto-upload="false">
                                            <div tabindex="0"
                                                 class="el-upload el-upload--picture-card">
                                                <i class="el-icon-plus"/>
                                            </div>
                                        </el-upload>
                                    </li>

                                </ul>

                            </div>
                        </el-col>
                        <el-col :span="12">
                            <label>Ảnh bìa</label>
                            <div class="source d-flex">
                                <ul class="el-upload-list el-upload-list--picture-card " style="display: contents">
                                    <template
                                        v-for="(link,i) in list_anh_bia"
                                    >
                                        <li
                                            tabindex="0"
                                            class="el-upload-list__item is-ready"
                                        >
                                            <div class="w-100 h-100">
                                                <img
                                                    :src="link.link"
                                                    alt=""
                                                    class="el-upload-list__item-thumbnail"
                                                >
                                            </div>
                                        </li>
                                    </template>
                                    <li>
                                        <div>
                                            <el-upload
                                                ref="uploadShop"
                                                :show-file-list="false"
                                                :on-change="uploadFile"
                                                accept=".jpeg,jfif,.jpg,.png"
                                                action="/"
                                                :auto-upload="false"
                                            >
                                                <div
                                                    tabindex="0"
                                                    class="el-upload el-upload--picture-card"
                                                >
                                                    <i
                                                        class="el-icon-plus"
                                                    /></div>
                                            </el-upload>
                                        </div>
                                    </li>

                                </ul>

                            </div>
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
        </el-col>
        <el-col :span="24">
            <el-dialog
                title="Chỉnh sửa tài liệu"
                :visible.sync="show_update"
                custom-class="minWidth375"
                fullscreen
                :before-close="handleClose">
                <div>
                    <el-row :gutter="24">
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Chương trình đào tạo</label>
                            <eselect style="width:100%" @change="chonChuongTrinhDaoTao" collapseTags
                                     v-model="dataUpdate.ctdt"
                                     :placeholder="'Chọn'" filterable
                                     :data="list_chuong_trinh_dao_tao" :fields="['ten','id']"/>
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Áp dụng làm tài liệu chính cho môn</label>
                            <el-select v-model="dataUpdate.mon_hoc_chinh" style="width: 100%" filterable
                                       placeholder="Chọn">
                                <el-option
                                    v-for="item in list_mon_hoc"
                                    :key="item.id"
                                    :label="item.ten_mon"
                                    :value="item.id">
                                </el-option>
                            </el-select>
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Áp dụng làm tài liệu phụ cho môn</label>

                            <eselect style="width:100%" multiple collapseTags v-model="dataUpdate.mon_hoc_phu"
                                     :placeholder="'Chọn'" filterable
                                     :data="list_mon_hoc" :fields="['ten_mon','id']"/>
                            <!--                            <el-select v-model="dataAdd.mon_hoc_phu" style="width: 100%" filterable placeholder="Chọn">-->
                            <!--                                <el-option-->
                            <!--                                    v-for="item in list_mon_hoc"-->
                            <!--                                    :key="item.id"-->
                            <!--                                    :label="item.ten_mon"-->
                            <!--                                    :value="item.id">-->
                            <!--                                </el-option>-->
                            <!--                            </el-select>-->
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Tên tài liệu</label>
                            <el-input type="text" placeholder="Nhập" clearable
                                      v-model="dataUpdate.ten_tai_lieu"></el-input>
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Mô tả </label>
                            <el-input type="text" placeholder="Nhập" clearable
                                      v-model="dataUpdate.mo_ta"></el-input>
                        </el-col>
                        <el-col :xs="12" :sm="8" :md="6" :lg="6" :xl="6">
                            <label>Tác giả</label>
                            <el-select
                                no-match-text="Không tìm thấy"
                                no-data-text="Nhập nội dung sau đó nhấn enter"
                                v-model="dataUpdate.tac_gia"
                                multiple
                                filterable
                                style="width:100%"
                                allow-create
                                default-first-option
                                placeholder="Nhập">
                                <el-option
                                    v-for="item in []"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                                </el-option>
                            </el-select>
                        </el-col>
                        <el-col :xs="12" :sm="24" :md="6" :lg="6" :xl="6">
                            <label>Loại tài liệu</label>
                            <el-select v-model="dataUpdate.loai" style="width: 100%" filterable placeholder="Chọn">
                                <el-option
                                    v-for="item in ds_loai_tai_lieu"
                                    :key="item.value"
                                    :label="item.name"
                                    :value="item.value">
                                </el-option>
                            </el-select>
                        </el-col>
                        <el-col :xs="12" :sm="24" :md="6" :lg="6" :xl="6">
                            <label>Thẻ</label>
                            <el-select
                                no-match-text="Không tìm thấy"
                                no-data-text="Nhập nội dung sau đó nhấn enter"
                                v-model="dataUpdate.tag"
                                multiple
                                filterable
                                style="width:100%"
                                allow-create
                                default-first-option
                                placeholder="Nhập">
                                <el-option
                                    v-for="item in []"
                                    :key="item.value"
                                    :label="item.label"
                                    :value="item.value">
                                </el-option>
                            </el-select>
                        </el-col>
                        <el-col v-if="file_tai_lieu" :span="6">
                            <label>Tài liệu đã chọn</label>
                            <div class="source d-flex">
                                <ul class="el-upload-list el-upload-list--picture-card " style="display: contents">
                                    <li style="width: 100%; margin: 0"
                                        tabindex="0"
                                        class="el-upload-list__item is-ready"
                                    >
                                        <el-alert
                                            :title="file_tai_lieu.name"
                                            type="success"
                                            effect="dark">
                                        </el-alert>
                                    </li>
                                </ul>

                            </div>
                        </el-col>
                        <el-col :span="6">
                            <label>Tài liệu</label>
                            <div class="source d-flex">
                                <ul class="el-upload-list el-upload-list--picture-card " style="display: contents">
                                    <li>
                                        <el-upload
                                            ref="uploadShop"
                                            :show-file-list="false"
                                            :on-change="uploadFileTaiLieu"
                                            accept=".docx,.doc,.pdf"
                                            action="/"
                                            :auto-upload="false">
                                            <div tabindex="0"
                                                 class="el-upload el-upload--picture-card">
                                                <i class="el-icon-plus"/>
                                            </div>
                                        </el-upload>
                                    </li>

                                </ul>

                            </div>
                        </el-col>
                        <el-col :span="12">
                            <label>Ảnh bìa</label>
                            <div class="source d-flex">
                                <ul class="el-upload-list el-upload-list--picture-card " style="display: contents">
                                    <template
                                        v-for="(link,i) in list_anh_bia"
                                    >
                                        <li
                                            tabindex="0"
                                            class="el-upload-list__item is-ready"
                                        >
                                            <div class="w-100 h-100">
                                                <img
                                                    :src="link.link"
                                                    alt=""
                                                    class="el-upload-list__item-thumbnail"
                                                >
                                            </div>
                                        </li>
                                    </template>
                                    <li>
                                        <div>
                                            <el-upload
                                                ref="uploadShop"
                                                :show-file-list="false"
                                                :on-change="uploadFile"
                                                accept=".jpeg,jfif,.jpg,.png"
                                                action="/"
                                                :auto-upload="false"
                                            >
                                                <div
                                                    tabindex="0"
                                                    class="el-upload el-upload--picture-card"
                                                >
                                                    <i
                                                        class="el-icon-plus"
                                                    /></div>
                                            </el-upload>
                                        </div>
                                    </li>

                                </ul>

                            </div>
                        </el-col>
                        <el-col :span="24">
                            <label>Nội dung</label>
                            <vue-editor v-model="dataUpdate.noi_dung"/>
                        </el-col>
                    </el-row>
                </div>
                <span slot="footer" class="dialog-footer">
    <el-button @click="show_add = false">Đóng</el-button>
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
                ctdt: '',
                mon_hoc: '',
                ten_tai_lieu: ''
            },
            dataAdd: {
                ctdt: '',
                mon_hoc: '',
                ten_tai_lieu: '',
                mo_ta: '',
                noi_dung: '',
                tag: '',
                mon_hoc_chinh: '',
                mon_hoc_phu: [],
                tac_gia: '',
                loai: 1
            },
            ds_loai_tai_lieu: [
                {name: 'Đọc tại chỗ', value: 1},
                {name: 'Mang về', value: 2},
            ],
            list_data: [],
            list_chuong_trinh_dao_tao: [],
            list_mon_hoc: [],
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
            dataUpdate: {},
            updateTaiLieu: false,
            dataForm: [],
            list_anh_bia: [],
            file_tai_lieu: null

        }
    },
    mounted() {
        console.log('Mounted Chương trình đào tạo...');
        this.getChuongTrinhDaoTao();
        this.getMonHoc();
        this.getData();
    },
    methods: {
        getTenMonHoc(arr) {
            console.log('getTenMonHoc')
            console.log(arr)
            arr = arr.split(',').sort()
            let str = '';
            for (let i = 0; i < arr.length; i++) {
                for (let j = 0; j < this.list_mon_hoc.length; j++) {
                    if (arr[i] == this.list_mon_hoc[j].id) {
                        str += this.list_mon_hoc[j].ten_mon + '; '
                    }
                }
            }
            return str;
        },
        clickFile(link) {
            window.open(link, "_blank")
        },
        uploadFileTaiLieu(file, fileList) {
            console.log('uploadFileTaiLieu')
            console.log(file)
            console.log(fileList)
            this.updateTaiLieu = false;
            this.file_tai_lieu = null;
            if(file){
                this.file_tai_lieu = file.raw;
                this.updateTaiLieu = true
            }
        },
        uploadFile(file, fileList) {
            console.log('uploadFile')
            this.list_anh_bia = [];
            this.dataForm = [];
            fileList.forEach((item, x) => {
                const typeImage = /(png|jpg|jfif|jpeg)$/i
                if (item.raw) {
                    if (typeImage.exec(item.raw.type)) {
                        this.list_anh_bia.push({
                            type: 1,
                            link: URL.createObjectURL(item.raw)
                        })
                        this.dataForm.push(item.raw)
                    }
                } else {
                    this.thongBao('error', 'Vui lòng chọn đúng định dạng hình ảnh')
                }
            })
            this.$refs.uploadShop.clearFiles()
            this.$refs.uploadShop.value = null
        },
        chonChuongTrinhDaoTao() {
            this.dataSearch.mon_hoc = '';
            this.dataAdd.mon_hoc_chinh = '';
            this.dataUpdate.mon_hoc_chinh = '';
            this.dataAdd.mon_hoc_phu = [];
            this.dataUpdate.mon_hoc_phu = [];
            this.getMonHoc();
        },
        confirmDel(item) {

            this.$confirm('Xác nhận xoá thông tin ?', 'Thông báo', {
                confirmButtonText: 'Đồng ý',
                cancelButtonText: 'Hủy',
            })
                .then(_ => {
                    var url = '/admin/delete-tai-lieu'
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
                key: this.dataSearch.ten_tai_lieu
            }
            var url = '/admin/lay-danh-sach-tai-lieu'
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
        showUpdate(item) {
            this.dataUpdate = JSON.parse(JSON.stringify(item))
            this.dataUpdate.tac_gia = item.tac_gia.split(',').sort()
            this.dataUpdate.tag = item.tag.split(',').sort()
            this.dataUpdate.mon_hoc_phu = this.arrayStringToNumber(item.mon_hoc_phu.split(',').sort());
            this.dataUpdate.mon_hoc_chinh = parseInt(item.mon_hoc_chinh.id)
            this.dataUpdate.ctdt = ''
            this.file_tai_lieu = {
                name: item.link_file
            }
            this.list_anh_bia = [
                {
                    type: 1,
                    link: item.hinh_anh
                }
            ]
            console.log('data update:')
            console.log(this.dataUpdate)
            this.show_update = true;
        },
        getMonHoc() {
            let params = {
                start: 0,
                limit: 9999,
                ctdt: this.dataAdd.ctdt
            }
            var url = '/admin/lay-danh-sach-mon-hoc'
            this.loading.status = true;
            this.loading.text = 'Loading...'
            rest_api.post(url, params).then(
                response => {
                    if (response.data.rc == 0) {
                        this.list_mon_hoc = response.data.data;
                    } else {
                        this.list_mon_hoc = [];
                        this.thongBao('error', response.data.rd)
                    }
                    this.loading.status = false;
                }
            ).catch((e) => {
            })
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
        arrayStringToNumber(arr) {
            let arrOfNum = arr.map(str => {
                return parseInt(str, 10);
            });
            return arrOfNum
        },
        confirmUpdate() {
            console.log('confirmUpdate')
            var dataForm = new FormData();
            dataForm.append('mon_hoc_chinh', this.dataUpdate.mon_hoc_chinh);
            dataForm.append('mon_hoc_phu', this.dataUpdate.mon_hoc_phu.toString());
            dataForm.append('ten_tai_lieu', this.dataUpdate.ten_tai_lieu);
            dataForm.append('tac_gia', this.dataUpdate.tac_gia);
            dataForm.append('tag', this.dataUpdate.tag);
            dataForm.append('loai', this.dataUpdate.loai);
            dataForm.append('mo_ta', this.dataUpdate.mo_ta);
            dataForm.append('noi_dung', this.dataUpdate.noi_dung);
            if (this.updateTaiLieu) {
                dataForm.append('tai_lieu', this.file_tai_lieu, this.file_tai_lieu.name)
            }
            if (this.dataForm && this.dataForm.length) {
                Array
                    .from(Array(this.dataForm.length).keys())
                    .map(x => {
                        dataForm.append('anh_bia', this.dataForm[x], this.dataForm[x].name)
                    })
            }
            console.log('Gửi đi:')
            console.log(dataForm)
            rest_api.post('/admin/sua-tai-lieu', dataForm).then(
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
            if (this.dataAdd.mon_hoc_phu == '' || this.dataAdd.ten_tai_lieu == '' || this.dataAdd.mo_ta == '' || this.dataAdd.noi_dung == '' || this.dataAdd.tag.length == 0 || this.dataAdd.tac_gia.length == 0 || this.dataAdd.mon_hoc_chinh == '' || this.dataAdd.mo_ta == '') {
                this.thongBao('error', 'Vui lòng điền đầy đủ thông tin.')
                return
            }
            var dataForm = new FormData();
            console.log(this.file_tai_lieu)
            dataForm.append('mon_hoc_chinh', this.dataAdd.mon_hoc_chinh);
            dataForm.append('mon_hoc_phu', this.dataAdd.mon_hoc_phu.toString());
            dataForm.append('ten_tai_lieu', this.dataAdd.ten_tai_lieu);
            dataForm.append('tac_gia', this.dataAdd.tac_gia);
            dataForm.append('tag', this.dataAdd.tag);
            dataForm.append('mo_ta', this.dataAdd.mo_ta);
            dataForm.append('noi_dung', this.dataAdd.noi_dung);
            dataForm.append('tai_lieu', this.file_tai_lieu, this.file_tai_lieu.name)
            if (this.dataForm && this.dataForm.length) {
                Array
                    .from(Array(this.dataForm.length).keys())
                    .map(x => {
                        dataForm.append('anh_bia', this.dataForm[x], this.dataForm[x].name)
                    })
            }
            console.log(dataForm)
            rest_api.post('/admin/them-tai-lieu', dataForm).then(
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

.el-col {
    padding-top: 15px;
}

.el-col label {
    margin-bottom: 0;
}
</style>
