<template>
            <div class="post-preview">
                <a href="slug">
                    <h2 class="post-title">
                       {{ title }}
                    </h2>
                    <h3 class="post-subtitle">
                       {{ subtitle }}
                    </h3>
                </a>
                <p class="post-meta">Posted by <a href="#">Start Bootstrap</a>
                {{ created_at }}

                <a href="" @click.prevent="likeIt"> 
                    <small>0</small>
                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                </a>
                </p>
            </div>
</template>

<script>
    export default {
       
       props:[

           'title', 'subtitle', 'created_at'
       ],
       methods: {

             likeIt(){
                
               console.log('hello');
             }
       }
    }
</script>
