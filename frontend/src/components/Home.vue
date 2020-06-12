<template>
  <div>
    <v-container fluid>
      <v-layout row>
        <v-flex xs12>
          <v-carousel
            cycle
            height="400"
            hide-delimiter-background
            show-arrows-on-hover
          >
            <v-carousel-item
              v-for="(slide) in sliders"
              :key="slide.id"
              :src="slide.src"
            >
              <div class="carousel-link">
                <v-btn class="error" :to="'/add/' + slide.id">{{ slide.title }}</v-btn>
              </div>
            </v-carousel-item>
          </v-carousel>
        </v-flex>
      </v-layout>
    </v-container>

    <v-container>
      <v-layout row wrap>
        <v-flex
          xs12 sm6 md3
          v-for="slide in sliders" :key="card-slide.id">
          <v-card class="mx-auto" max-width="200">
            <v-img class="white--text align-end" height="200px"
              :src="slide.src"
            >
            </v-img>

            <v-card-subtitle class="pb-0">{{ slide.title }}</v-card-subtitle>

            <v-card-text class="text--primary">
              <div>{{ slide.description }}</div>

            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn flat>
                Share
              </v-btn>

              <v-btn raised class="primary">
                Buy
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
export default {
  name: 'Home',
  data () {
    return {
      sliders: [
        {
          id: 1,
          title: 'Toyota camry 2012',
          description: 'Toyota camry 2012',
          promo: false,
          src: 'https://lh4.googleusercontent.com/proxy/to-0HaasrqE-iaCx8bfKrtcVY7uyORaC3djQz9Yn8evuEc3NL8Md1sv8flsCnjYbXfmb6IbRkGGkNT1WpmoiukoieA'
        }, {
          id: 2,
          title: 'Toyota corolla 2016',
          description: 'Toyota corolla 2016',
          promo: false,
          src: 'http://www.autos.ca/wp-content/uploads/2015/10/2015-Toyota-Corolla-SE-JY-01-1024x683.jpg'
        }, {
          id: 1,
          title: 'Toyota camry 2012',
          description: 'Toyota camry 2012',
          promo: false,
          src: 'https://lh4.googleusercontent.com/proxy/to-0HaasrqE-iaCx8bfKrtcVY7uyORaC3djQz9Yn8evuEc3NL8Md1sv8flsCnjYbXfmb6IbRkGGkNT1WpmoiukoieA'
        }, {
          id: 2,
          title: 'Toyota corolla 2016',
          description: 'Toyota corolla 2016',
          promo: false,
          src: 'http://www.autos.ca/wp-content/uploads/2015/10/2015-Toyota-Corolla-SE-JY-01-1024x683.jpg'
        }
      ]
    }
  }
}
</script>

<style scoped>
  .carousel-link {
    position: absolute;
    bottom: 50px;
    left: 50%;
    background-color: rgb(0, 0, 0, .5);
    transform: translate(-50%, 0);
    padding: 5px 15px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
  }
</style>
