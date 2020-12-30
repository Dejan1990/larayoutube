<template>
    <div class="card mt-5 p-5">
        <div class="form-inline my-4 w-full">
                <input type="text" class="form-control form-control-sm w-80">
                <button class="btn btn-sm btn-primary">
                    <small>Add comment</small>
                </button>
        </div>
        <div class="media my-3" v-for="comment in comments.data" :key="comment.id">
            <!--<img width="30" height="30" class="rounded-circle mr-3" src="https://picsum.photos/id/42/200/200">-->
            <avatar :username="comment.user.name" :size="30" style="margin-right: 15px;"></avatar>

            <div class="media-body">
                <h6 class="mt-0">{{ comment.user.name }}</h6>
                <small>{{ comment.body }}</small>

                <votes :default_votes="comment.votes" :entity_id="comment.id" :entity_owner="comment.user.id"></votes>
                <replies :comment="comment"></replies>
            </div>
        </div>
        <div class="text-center">
            <button v-if="comments.next_page_url" @click="fetchComments" class="btn btn-success">Load more</button>
            <!-- v-if="comments.next_page_url" postavljamo da resimo gresku vracanja od prve strane komentara kad sve pregledamo -->

            <span v-else class="text-danger">No more comments to show :)</span>
        </div>
    </div>
</template>
<script>
import Avatar from 'vue-avatar'
import Replies from './replies.vue'

export default {
    props: ['video'],

    components: { Avatar, Replies },

   mounted() {
       this.fetchComments();
   }, 

   data() {
       return {
           comments: {
               data: []
           }
       }
   },

   methods: {
       fetchComments() {
           const url = this.comments.next_page_url ? this.comments.next_page_url : `/videos/${this.video.id}/comments`
           axios.get(url).then(({ data }) => {
               this.comments = { // pravimo novi objekat i mi spreading sve podatke sa servera, osim data property data: this.comments.data.push(data.data)
                   ...data,
                   data: [
                       //for data property we gonna push the new comments comming from the server(data.data) in to the old comments(this.comments.data)
                       ...this.comments.data,
                       ...data.data
                   ] 
               }
           })
       }
   },
}
</script>