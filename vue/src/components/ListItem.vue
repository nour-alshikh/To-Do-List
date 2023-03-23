<template>
    <div class="d-flex justify-content-between align-items-center px-4 w-50 m-auto my-4">
        <label class="checkbox-btn mt-0">
        <label for="checkbox"></label>
        <input id="checkbox" type="checkbox"  @change="updateItem()"
            v-model="item.completed" />
        <span class="checkmark"></span>
        </label>
        <span :class="[item.completed ? 'completedd' : '' , 'itemText']">{{ item.name }}</span>
        <div>
            <font-awesome-icon icon = "fa-solid fa-trash" @click="deleteItem()" class=" trash fs-6" />
        </div>
    </div>


</template>

<script>
import axios from 'axios'
    export default {
        props:['item'],
        methods:{
            updateItem(){
                axios.put('http://localhost:8000/api/item/' + this.item.id , {item: this.item})
                .then((response)=>{
                    if(response.status == 200){
                        this.$emit('itemChanged')
                    }
                })
                .catch((err)=>{
                    console.log(err);
                })
            },
            deleteItem(){

                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#41b6b6',
                cancelButtonColor: '#6e6e6e',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('http://localhost:8000/api/item/' + this.item.id)
                        .then((response) => {
                            if (response.status == 200) {
                                this.$emit('itemChanged')
                            }
                        })
                        .catch((err) => {
                            console.log(err);
                        })
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Your file has been deleted.',
                        icon :'success',
                        confirmButtonColor: '#41b6b6',
                    }
                    )
                }
            })

            }
        }
    }
</script>

<style scoped>
.itemText{
    padding: 20px;
}
.completedd{
    text-decoration: line-through;
}

.trash{
    color: #6e6e6e;
    cursor: pointer;
    transition: 0.6s;
}
.trash:hover{
    color: #dc3545;
}
/* Customize the label (the checkbox-btn) */
.checkbox-btn {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 10px;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default checkbox */
.checkbox-btn input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
  height: 0;
  width: 0;
}

.checkbox-btn label {
  cursor: pointer;
  font-size: 14px;
}
/* Create a custom checkbox */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  border: 2.5px solid #ffffff;
  transition: .2s linear;
}
.checkbox-btn input:checked ~ .checkmark {
  background-color: transparent;
}

/* Create the checkmark/indicator (hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  visibility: hidden;
  opacity: 0;
  left: 50%;
  top: 40%;
  width: 10px;
  height: 14px;
  border: 2px solid #0ea021;
  filter: drop-shadow(0px 0px 10px #0ea021);
  border-width: 0 2.5px 2.5px 0;
  transition: .2s linear;
  transform: translate(-50%, -50%) rotate(-90deg) scale(0.2);
}

/* Show the checkmark when checked */
.checkbox-btn input:checked ~ .checkmark:after {
  visibility: visible;
  opacity: 1;
  transform: translate(-50%, -50%) rotate(0deg) scale(1);
  animation: pulse 1s ease-in;
}

.checkbox-btn input:checked ~ .checkmark {
  transform: rotate(45deg);
  border: none;
}

@keyframes pulse {
  0%,
  100% {
    transform: translate(-50%, -50%) rotate(0deg) scale(1);
  }
  50% {
    transform: translate(-50%, -50%) rotate(0deg) scale(1.6);
  }
}


</style>
