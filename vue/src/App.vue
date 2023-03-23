<script>
import axios from "axios";
import AddItemForm from "./components/AddItemForm.vue";
import ListView from "./components/ListView.vue";

export default {
    created(){

    },
    mounted(){
        this.getList()
    },
    data(){
        return{
            items: []
        }
    },
    components:{
        AddItemForm,
        ListView
    },
    methods:{
          async getList () {
            await axios.get('http://localhost:8000/api/items')
                .then((response) => {
                    this.items = response.data
                })
                .catch(err => {
                    console.log(err);
                })
        },
    }
}

</script>

<template>
    <div class="todolistcontainer">
        <div class="box">
            <div class="heading">
                <h2 class="title">To Do List</h2>
                <add-item-form v-on:reloadList="getList()" />
            </div>
        </div>
        <list-view :items="items" v-on:reloadList="getList()" />
    </div>
</template>

<style scoped>
.todolistcontainer{
    min-height: 100vh;
    /* Permalink - use to edit and share this gradient: https://colorzilla.com/gradient-editor/#f6e6b4+0,ed9017+100;Yellow+3D+%231 */
    background: #c7e0e0; /* Old browsers */
    background: -moz-linear-gradient(-45deg,  #d2dfdf 0%, #c7e0e0 100%); /* FF3.6-15 */
    background: -webkit-linear-gradient(-45deg,  #d2dfdf 0%,#c7e0e0 100%); /* Chrome10-25,Safari5.1-6 */
    background: linear-gradient(135deg,  #d2dfdf 0%,#c7e0e0 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6e6b4', endColorstr='#ed9017',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
    width: 100%;
    margin: auto;
    padding: 30px;
}

.box{
    padding: 30px;
    margin: auto;
    width: 50%;
    border-radius: 25px;
    background: linear-gradient(225deg, #d5f0f0, #b3caca);
    box-shadow:  -18px 18px 36px #b3caca,
                18px -18px 36px #dbf6f6;
}
.heading{
    padding: 30px;
}
.title{
    color: #193f3f;
    text-align: center;
}
</style>
