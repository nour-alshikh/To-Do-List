<template>
    <div>
        <div v-if="items.length > 0">
            <div v-for="(item , index) in items" :key="index">
                <list-item :item="item" class="item"  v-on:itemChanged="$emit('reloadList')" />
            </div>
        </div>
        <div v-else>
            <h1 class="text-center my-5">No thing to do...</h1>
        </div>
    </div>
</template>

<script>
import ListItem from './ListItem.vue';

export default {
    props:['items'],
    components:{
        ListItem
    }
}

</script>

<style scoped>
    .item{
        margin: 40px;
        background-color: transparent;
        border-radius: 10px;
        background: linear-gradient(225deg, #b3caca, #d5f0f0);
        box-shadow:  -20px 20px 40px #a5baba,
                    20px -20px 40px #e9ffff;
    }
    h1{
        color: #193f3f;
    }
</style>
