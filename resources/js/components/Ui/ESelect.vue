<template>
  <el-select ref="el_select" :clearable="clearable" :disabled="disabled" v-model="Content" :multiple="multiple" :collapse-tags="collapseTags" :placeholder="placeholder" @change="onChange" @input="onInput" :filterable="filterable" :no-data-text="'Không có bản ghi nào'" :no-match-text="'Không tìm thấy bản ghi nào'">
      <el-option v-if="!multiple" :key="-1" :label="placeholder" value=""></el-option>
      <li v-else class="el-select-dropdown__item"><label style="font-weight:normal;"><input type="checkbox" @change="onCheckAllChange" v-model="CheckAll"> Chọn tất cả</label></li>
      <el-option v-for="(item, index) in data" :key="index" :label="getLabel(item)" :disabled="item.disabled" :value="getValue(item)"></el-option>
  </el-select>
</template>
<script>
import {Select} from 'element-ui';
export default {
    components: {
        Select
    },
    props: {
        clearable : {
            default: false,
        },
        value: {
            required: true
        },
        disabled: {
            type: Boolean,
            default: false
        },
        data: {
            default: [],
            required: true
        },
        placeholder: {
            default: "",
        },
        filterable: {
            type: Boolean,
            default: false
        },
        multiple: {
            type: Boolean,
            default: false
        },
        "collapse-tags": {
            type: Boolean,
            default: false
        },
        fields: {
            type: Array,
            required: true
        },
        // style: {
        //     type: String
        // }
    },
    watch: {
        value(){
            this.Content = this.value;
        },
        data(){
            if(this.multiple){
                if(this.Content.length == this.data.length){
                    this.CheckAll = true;
                }else{
                    this.CheckAll = false;
                }
            }
        }
    },
    mounted(){
    },
    data(){
        return {
            Content: this.value,
            CheckAll: false
        }
    },
    methods: {
        onCheckAllChange(){
            if(this.CheckAll){
                console.log("Chọn tất cả")
                this.Content = [];
                if(this.fields[1]){
                    this.data.map((obj) => {
                        this.Content.push(obj[this.fields[1]]);
                        this.$emit('input', this.Content);
                    })
                }
            this.$emit('change', this.Content);
            }else{
                console.log("Bỏ chọn tất cả")
                this.Content = [];
                this.$emit('change', this.Content);
                this.$emit('input', this.Content);
            }
        },
        focus(){
            this.$refs.el_select.focus();
        },
        onChange(e){
            if(this.Content.length == this.data.length){
                this.CheckAll = true;
            }else{
                this.CheckAll = false;
            }
            this.$emit('change', e);
        },
        onInput(e){
            this.$emit('input', e);
        },
        getLabel(item){
            if(!this.fields[0]){
                return;
            }
            return item[this.fields[0]];
        },
        getValue(item){
            if(!this.fields[1]){
                return;
            }
            return item[this.fields[1]];
        }
    }
}
</script>

<style>

</style>
