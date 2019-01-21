<template>
    <li class="has-children" v-if="node.children" @click.right.prevent="handleRightClick">
        <input type="checkbox" :name="nodeId" :id="nodeId">
        <label :for="nodeId" :id="node.file.id">{{ node.file.label }}</label>

        <ul v-if="node.children">
            <tree-menu v-for="(child, key) in node.children" :key="nodeId + key" :node="child" :node-id="'sub-' + nodeId + key"></tree-menu>
        </ul>
    </li>
    <li v-else>
        <a href="#0" :id="node.file.id" @click="readFile" @click.right.prevent="handleRightClick">{{ node.file.label }}</a>
    </li>
</template>
<script>
    import Vuex from 'vuex';
    import contextMenu from 'vue-context-menu';

    export default {
        data() {
            return {
                content: '',
            }
        },
        props: ['node', 'nodeId'],
        name: 'tree-menu',
        methods: {
            handleRightClick: function(event) {
                this.$store.commit('setCurrentFile', event.target.id);
                this.$parent.$refs.ctxMenu.open();
                event.stopPropagation();
            },
            readFile: function(event){
                this.$store.commit('setCurrentFile', event.target.id);
                var self = this;
                let data = {
                    id: event.target.id
                };
                axios.post('/file/postRead', data)
                .then(function (response) {
                    if (response.data.returnCode == 1) {
                        self.$store.commit('setFileContent', response.data.data);
                    }
                })
            },
        },
    }
</script>
