<template>
    <div>
    
    </div>
</template>



<script>
import toastr from 'toastr';
window.toastr = require('toastr')
export default {
    name: "Logout-menu",
    created(){
        this.$store.dispatch('logout').then(res => {
          toastr.success (res.message)
              this.$router.push({
                name: "login"
              })
            })
    }
}
</script>