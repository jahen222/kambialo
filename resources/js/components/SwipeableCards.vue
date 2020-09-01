<template>
  <section class="container" style="position: relative; padding: 25px;">
    <div class="alert-success text-center" style="opacity: 0; transition: 1s; font-size: 16pt;" id="xtra-message">
        <div>Agregado a favorito</div>
    </div>
    <div style="margin-top: 10px;">
      <form class="row" v-on:submit.prevent="search" style="align-items: flex-end">
        <div class="form-group col-sm-3">
          <small class="form-text text-muted">Categoria</small>
          <select name="category" class="form-control" v-model="form.catagory">
            <option selected>Seleccione Categoria</option>
            <option v-for="x,y in categories" :value="x.id">{{x.name}}</option>
          </select>
        </div>
        <div class="form-group col-sm-9">
          <input placeholder="Buscador" class="form-control" v-model="form.search" type="text"/>
        </div>
      </form>
    </div>
    <div style="height:70vh; width:80vh; position:relative; margin: auto;">
      <div
        v-if="!isLoading && current"
        class="some"
        style="z-index: 3"
        :class="{ 'transition': isVisible }">
        <Vue2InteractDraggable
          v-if="isVisible"
          :interact-out-of-sight-x-coordinate="500"
          :interact-max-rotation="15"
          :interact-x-threshold="200"
          :interact-y-threshold="200"
          :interact-event-bus-events="interactEventBus"
          interact-block-drag-down
          @draggedRight="emitAndNext('match')"
          @draggedLeft="emitAndNext('reject')"
          @draggedUp="emitAndNext('skip')"
          class="rounded-borders card card--one">
          <div style="height: 100%">
            <img
              :src="'images/'+currentImage"
              class="rounded-borders"/>
            <a v-if="current.images.length > 0" a class="img-btn img-btn--prev" @click="prevImage" href="#!">&#10094;</a>
            <a v-if="current.images.length > 0" a class="img-btn img-btn--next" @click="nextImage" href="#!">&#10095;</a>
            <div v-if="current.images.length > 0" id="image-selector" class="image-selector">
              <input type="radio" name="image_controller" @click="selectImage(0)" checked/>
              <input type="radio" name="image_controller" @click="selectImage(y + 1)" v-for="x,y in current.images"/>
            </div>
            <div class="text">
              <h2>{{current.name}}</h2>
            </div>
          </div>
        </Vue2InteractDraggable>
      </div>
      <div
        v-if="!isLoading && next"
        class="rounded-borders card card--two "
        style="z-index: 2">
        <div style="height: 100%">
          <img
            :src="'images/' + next.cover_image"
            class="rounded-borders"/>
          <div class="text">
              <h2>{{next.name}}</h2>
            </div>
        </div>
      </div>
      <div
        v-if="!isLoading && current"
        class="rounded-borders card card--three "
        style="z-index: 1">
        <div style="height: 100%">
        </div>
      </div>
      <div
        v-if="!isLoading && !current && !next"
        class="rounded-borders card card--flex "
        style="z-index: 1">
        <div>No hay mas productos</div>
      </div>
      <div
        v-if="isLoading"
        class="rounded-borders card card--flex "
        style="z-index: 1">
        <div>...Cargando</div>
      </div>
    </div>

    <div v-if="!isLoading && current" class="footer">
      <div class="btn btn-danger" @click="reject" title="Rechazar">
          Mas tarde
      </div>
      <div class="btn btn-primary" @click="match" title="Favorito">
          Me gusta
      </div>
    </div>
  </section>
</template>
<script>
import { Vue2InteractDraggable, InteractEventBus } from 'vue2-interact'
import axios from 'axios';

const EVENTS = {
  MATCH: 'match',
  SKIP: 'skip',
  REJECT: 'reject'
}

const DEFAULTS = {
  COVER: 0
}

var timeout = '';

export default {
  name: 'SwipeableCards',
  components: { Vue2InteractDraggable },
  data() {
    return {
      isLoading: false,
      isVisible: true,
      index: 0,
      categories: [],
      imageIndex: DEFAULTS.COVER,
      interactEventBus: {
        draggedRight: EVENTS.MATCH,
        draggedLeft: EVENTS.REJECT,
        draggedUp: EVENTS.SKIP
      },
      cards: [],
      form: {
        category: '',
        search: ''
      }
    }
  },
  created: function(){
    this.fetchData();
  },
  computed: {
    currentImage(){
      const images = this.buildCardImages();
      if(!images[this.imageIndex])
        this.imageIndex = DEFAULTS.COVER;

      if(document.getElementById('image-selector')){
        const inputs = document.getElementById('image-selector').getElementsByTagName('input');
        inputs[this.imageIndex].checked = true;
      }

      return images[this.imageIndex].image;
    },
    current() {
      if(!this.cards[this.index])
        this.index = 0;
      return this.cards[this.index]
    },
    next() {
      if(this.cards[this.index + 1])
        return this.cards[this.index + 1]
      return this.cards[0]
    }
  },
  methods: {
    async search() {
      this.isLoading = true;
      console.log(this.form);
      const response = await axios.get(`showcase/search`, {params: this.form})
      this.cards = response.data;
      this.isLoading = false;
    },
    buildCardImages(){
      if(this.cards[this.index])
        return [{image: this.cards[this.index].cover_image},...this.cards[this.index].images]
      return [];
    },
    selectImage(index){
      if(index !== undefined)
        this.imageIndex = index;
    },
    nextImage() {
      this.imageIndex += 1;
    },
    prevImage() {
      this.imageIndex -= 1;
    },
    async fetchData() {
      this.isLoading = true;
      const response = await axios.get(`showcase/data`)
      if (response.data) {
        this.cards = response.data.products;
        this.categories = response.data.categories;
      }
      this.isLoading = false;
    },
    async favorite(index)
    {
      const card = this.cards[index];
      const response = await axios.post(`showcase/favorite`, {id: card.id});
      if(response.data.success){
        this.cards.splice(index, 1);
        this.index--;
      }
    },
    match() {
      InteractEventBus.$emit(EVENTS.MATCH)
    },
    reject() {
      InteractEventBus.$emit(EVENTS.REJECT)
    },
    skip() {
      InteractEventBus.$emit(EVENTS.SKIP)
    },
    emitAndNext(event) {
      clearTimeout(timeout);
      const element = document.getElementById('xtra-message');
      element.style.opacity = 0;

      if(event=='match'){
        element.style.opacity = 1;
        timeout = setTimeout(function(){
          element.style.opacity = 0;
        },1500);
        this.favorite(this.index)
      }

      this.$emit(event, this.index)
      setTimeout(() => this.isVisible = false, 200)
      setTimeout(() => {
        this.index++
        this.imageIndex = DEFAULTS.COVER;
        this.isVisible = true
      }, 200)
    }
  }
}
</script>

<style lang="scss" scoped>
.image-selector{
  position: absolute;
  text-align:center;
  top:0;
  width: 100%;
}

.container {
  background: #eceff1;
  width: 100%;
  /*height: 100vh;*/
}

.img-btn{
  position: absolute;
  top: 40%;
  font-size: 50px;
  &--prev{
    left: 0;
  }
  &--next{
    right: 0;

  }
}

.header {
  width: 100%;
  height: 60vh;
  z-index: 0;
  top: 0;
  left: 0;
  color: white;
  text-align: center;
  font-style: italic;
  font-family: 'Engagement', cursive;
  background: #f953c6;
  background: -webkit-linear-gradient(to top, #b91d73, #f953c6);
  background: linear-gradient(to top, #b91d73, #f953c6);
  clip-path: polygon(0 1%, 100% 0%, 100% 76%, 0 89%);
  display: flex;
  justify-content: space-between;
  span {
    display: block;
    font-size: 4rem;
    padding-top: 2rem;
    text-shadow: 1px 1px 1px red;
  }
  i {
    padding: 24px;
  }
}

.footer {
  width: 77vw;
  bottom: 0;
  display: flex;
  padding-bottom: 30px;
  justify-content: center;
  align-items: center;
}

.btn-c {
  position: relative;
  width: 50px;
  height: 50px;
  padding: .2rem;
  border-radius: 50%;
  background-color: white;
  box-shadow: 0 6px 6px -3px rgba(0,0,0,0.02), 0 10px 14px 1px rgba(0,0,0,0.02), 0 4px 18px 3px rgba(0,0,0,0.02);
  cursor: pointer;
  transition: all .3s ease;
  user-select: none;
  -webkit-tap-highlight-color:transparent;
  &:active {
    transform: translateY(4px);
  }
  i {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    &::before {
      content: '';
    }
  }
  &--like {
    background-color: red;
    padding: .5rem;
    color: white;
    box-shadow: 0 10px 13px -6px rgba(0,0,0,.2), 0 20px 31px 3px rgba(0,0,0,.14), 0 8px 38px 7px rgba(0,0,0,.12);
    i {
      font-size: 32px;
    }
  }
  &--decline {
    color: red;
  }
  &--skip {
    color: green;
  }
}

.flex {
  display: flex;
  &--center {
    align-items: center;
    justify-content: center;
  }
}

.fixed {
  position: fixed;
  &--center {
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }
  &--xtra-message{
    transition: 0.5s;
    left: 50%;
    transform: translateX(-50%);
    width: 77vw;
    z-index: 4;
    text-align: center;
  }
}
.rounded-borders {
  border-radius: 12px;
}
.card {
  /*width: 80vw;*/
  width: 100%;
  position:absolute;
  height: 60vh;
  color: white;
  img {
    object-fit: cover;
    display: block;
    width: 100%;
    height: 100%;
  }
  &--one {
    z-index: 3;
    box-shadow: 0 1px 3px rgba(0,0,0,.2), 0 1px 1px rgba(0,0,0,.14), 0 2px 1px -1px rgba(0,0,0,.12);
  }
  &--two {
    z-index: 2;
    /*transform: translate(-48%, -48%);*/
    top: 2vh;
    left: 2vh;
    box-shadow: 0 6px 6px -3px rgba(0,0,0,.2), 0 10px 14px 1px rgba(0,0,0,.14), 0 4px 18px 3px rgba(0,0,0,.12);
  }
  &--three {
    z-index: 1;
    top: 4vh;
    left: 4vh;
    background: rgba(black, .8);
    /*transform: translate(-46%, -46%);*/
    box-shadow: 0 10px 13px -6px rgba(0,0,0,.2), 0 20px 31px 3px rgba(0,0,0,.14), 0 8px 38px 7px rgba(0,0,0,.12);
  }
  &--flex{
    display: flex;
    background: transparent;
    border: 0;
    > * {
      margin: auto;
      color: black;
    }
  }
  .text {
    position: absolute;
    bottom: 0;
    width: 100%;
    background:black;
    background:rgba(0,0,0,0.5);
    border-bottom-right-radius: 12px;
    border-bottom-left-radius: 12px;
    text-indent: 20px;
    span {
      font-weight: normal;
    }
  }
}

.transition {
  animation: appear 200ms ease-in;
}

@keyframes appear {
  from {
    transform: translate(-48%, -48%);
  }
  to {
    transform: translate(-50%, -50%);
  }
}
</style>
