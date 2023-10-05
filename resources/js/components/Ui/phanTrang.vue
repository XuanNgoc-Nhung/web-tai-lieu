<template>
    <el-col :span="24" class="pt-3" >
        <div>
            <p><i>Hiển thị từ <span style="color:#478fca">{{start}} - {{to}}</span> /Tổng số
                <b>{{total_rows}}</b> bản ghi</i></p>
        </div>
        <b-pagination class="pull-right" style="margin:0" :first-text="pagination.first_text" :limit="9"
                      :last-text="pagination.last_text" :total-rows="total_rows" :prev-text="pagination.next_text"
                      :next-text="pagination.prev_text" v-model="trangHienTai" @change="chonTrangHienThi"
                      :per-page="pagination.limit">
        </b-pagination>
    </el-col>
</template>

<script>
import {
    PaginationPlugin
} from 'bootstrap-vue';
Vue.use(PaginationPlugin);

export default {
    props: [
        'batdau',
        'tongbanghi',
    ],
    watch: {
        batdau() {
            console.log("Đưa về trang 1");
            this.trangHienTai = 1;
            this.start = 0;
            this.onPageChange();
        },
        tongbanghi: function (newVal, oldVal) {
            console.log('Tổng bản ghi thay đổi')
            console.log(newVal)
            console.log(this.tongbanghi)
            this.total_rows = this.tongbanghi
            this.rebuild();
            console.log("Số lượng tổng bản ghi thay đổi" + this.total_rows)
        },
    },

    data() {
        return {
            trangHienTai: 1,
            pagination: {
                "next_text": "«",
                "prev_text": "»",
                "per_page": 10,
                "first_text": "Đầu",
                "last_text": "Cuối",
                "limit": 10,
            },
            start: 0,
            to: 10,
            total_rows:0,
        }
    },

    mounted() {
        //this.rebuild();
        this.total_rows = this.tongbanghi
        this.rebuild()
    },

    methods: {
        chonTrangHienThi(number) {
            console.log(number)
            // console.log("Chọn trang");
            this.trangHienTai = number;
            console.log(this.trangHienTai)
            console.log("*****")
            this.onPageChange();
            // loadingtmp.close();

        },


        onPageChange() {
            console.log("Trang hiện tại: " + this.trangHienTai);
            let ret = {
                start: (this.trangHienTai - 1) * this.pagination.limit,
                limit: this.pagination.limit,
                currentPage: this.trangHienTai,
            };
            this.rebuild();
            console.log("ret = " + JSON.stringify(ret));
            this.$emit("pageChange", ret);
        },
        rebuild() {
            this.start = (this.trangHienTai - 1) * this.pagination.limit + 1;
            this.to = (this.trangHienTai) * this.pagination.limit;
            console.log("curent paage: " + this.trangHienTai);
            console.log("s = " + this.start + ", to = " + this.to);
            console.log('total row : ' + this.total_rows);
            if (this.trangHienTai * this.pagination.limit <= this.total_rows) {
                this.to = this.trangHienTai * this.pagination.limit;
            } else {
                if(this.total_rows==0){
                    this.to = 0
                }
                else{
                    this.to = this.total_rows;
                }
            }
        }

    }

}

</script>

<style scoped>
.inline {
    display: -webkit-box;
    /* margin: 20px 0; */
}

.inline p {
    vertical-align: middle;
    line-height: 34px;
    padding: 0 5px;
}

.vanban {
    display: -webkit-inline-box;
    line-height: 34px;
    text-align: right;
    text-align: right;
    float: right;
    padding-right: 15px;
}

.pagination>.active>a {
    z-index: 0 !important;
}

.pagination {
    margin: 0 im !important;
}

</style>
