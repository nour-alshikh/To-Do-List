<template>
    <div class="additem d-flex justify-content-center align-items-center">
        <input type="text" v-model="item.name" />
        <font-awesome-icon
            :class="[ item.name ? 'enabled' : 'disabled' , 'fs-3' ]"
            icon = "fa-solid fa-plus-square"
            @click="addItem"
            />

    </div>
</template>

<script>
import axios from 'axios';

export default{
    data(){
        return{
            item:{
                name:''
            }
        }
    },
    methods:{
        addItem () {
            if(this.item.name == ''){
                return Swal.fire({
                    title:'You have to write something',
                      confirmButtonColor: '#41b6b6',
                })
            }
            let form = new FormData();
            form.append('name', this.item.name);

            axios.post('http://localhost:8000/api/item/store', form)
                .then(response => {
                    if (response.status == 201) {
                        this.item.name = ""
                        toast.fire({
                            icon: 'success',
                            title: 'Item added to list',
                            timer:1500,
                        })
                        this.$emit('reloadList')
                    }
                })
                .catch(err => {
                    console.log(err);
                })
        }
    }
}

</script>

<style scoped>
input{
    background-color: transparent;
    border-radius: 12px;
    background: linear-gradient(225deg, #b3caca, #d5f0f0);
    box-shadow:  -18px 18px 36px #a5baba,
                18px -18px 36px #e9ffff;
    border: none;
    outline: none;
    width: 100%;
    padding: 18px;
    margin: 20px;
}

.enabled{
    color: #41b6b6;
    cursor: pointer;
}
.disabled{
    color: #999;
}
</style>
