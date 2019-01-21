<template>
    <div id="container">
        <input type="text" class="col-md-3">
        <input type="button" class="btn btn-success btn-sm" @click="saveContent" value="save">
        <a href="/" class="btn btn-primary btn-sm pull-right">Quay lại</a>
        <div>
            <context-menu id="context-menu" ref="ctxMenu" class="context-menu">
                <li @click="route('newFile')">New file</li>
                <li @click="route('rename')">Rename...</li>
                <li @click="detailFolder">Detail</li>
                <hr>
                <li @click="route('newFolder')">New folder</li>
                <li @click="deleteFoder">Delete</li>
            </context-menu>
            <ul class="cd-accordion-menu animated col-md-3 container-file" @click.right.prevent="handleRightClick">
                <tree-menu :node="response" :node-id="'group-1'"></tree-menu>
            </ul>
            <input type="text" v-if="inputShow" v-model="fileName" ref="inputRename" id="inputRename" class="inputFile col-md-12" placeholder="..." @keyup.enter="callFunc" autofocus>
        </div>
        
        <textarea id="contentFile" v-if="!showFolder" cols="30" rows="10" class="col-md-9 code-section" :value="$store.state.currentFileContent" @keydown.ctrl.83.prevent="saveContent"></textarea>
        <div v-if="showFolder" class="col-md-9 code-section">
            <a href="#" @click.prevent="true">
                <div class="col-md-3 file-wrap">
                    <div class="file-sub-wrap col-md-12">
                        <div class="file-icon"></div>
                        <div class="file-name">www</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-3 file-wrap">
                    <div class="file-sub-wrap col-md-12">
                        <div class="file-icon"></div>
                        <div class="file-name">www</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-3 file-wrap">
                    <div class="file-sub-wrap col-md-12">
                        <div class="file-icon"></div>
                        <div class="file-name">www</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
            <a href="#">
                <div class="col-md-3 file-wrap">
                    <div class="file-sub-wrap col-md-12">
                        <div class="file-icon"></div>
                        <div class="file-name">www</div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </a>
        </div>
        <label for="" v-if="$store.state.currentFileName" class="label-file-name">{{ $store.state.currentFileName }}</label>
    </div>
</template>

<script>
import TreeMenu from './TreeMenu.vue';
import Vuex from 'vuex';
import contextMenu from 'vue-context-menu';

export default {
    data() {
        return {
            response: [],
            showFolder: false,
            inputShow: false,
            fileName: null,
            isFolder: 1,
            currentFileContent: '',
            mode: ''
        }
    },
    mounted() {
        var self = this;
        axios.post('/file/postIndex')
        .then(function (response) {
            self.response = response.data;
        })
        .catch(function (error) {
        });
    },
    methods: {
        clickFile: function() {
            this.showFolder = false;
        },
        route: function(mode){
            this.inputShow = true;
            this.mode = mode;
            this.$nextTick(() => {
                this.$refs.inputRename.focus();
            })
        },
        callFunc: function(){
            this[this.mode]();
            this.inputShow = false;
            this.fileName = '';
        },
        newFile: function(){
            let data = {
                id: this.$store.state.currentFileId,
                is_folder: 0,
                fileName: this.fileName
            };
            this.requestTo('/file/postCreate', data);
        },
        rename: function(){
            let data = {
                id: this.$store.state.currentFileId,
                fileName: this.fileName
            };
            this.requestTo('/file/postEdit', data);
        },
        detailFolder: function(){
            this.showFolder = true;
            let data = {
                id: this.$store.state.currentFileId,
                is_folder: 1,
                fileName: this.fileName
            };
            // this.requestTo('/file/fileDetail', data);
        },
        newFolder: function(){
            let data = {
                id: this.$store.state.currentFileId,
                is_folder: 1,
                fileName: this.fileName
            };
            this.requestTo('/file/postCreate', data);
        },
        deleteFoder: function(){
            let data = {
                id: this.$store.state.currentFileId
            };

            if (this.confirmAction('Xác nhận xóa!')) {
                this.requestTo('/file/postDelete', data);
            }
        },
        saveContent: function(){
            let contentFile = document.getElementById('contentFile').value;
            let data = {
                id: this.$store.state.currentFileId,
                content: contentFile
            };
            this.$store.commit('setFileContent', contentFile);
            this.requestTo('/file/postEditContent', data);
            // this.currentFileContent = '';
        },
        requestTo: function($url, $data){
            var self = this;
            axios.post($url, $data)
            .then(function (response) {
                if (response.data.returnCode == 1) {
                    self.response = response.data.data;
                }
            })
            .catch(function (error) {
                return null;
            });
        },
        confirmAction: function($message) {
            return confirm($message);
        },
    },
    components: {
        TreeMenu,
        contextMenu
    }
};
</script>
