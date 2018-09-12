<template>
  <div id="register">
    <input type="text" v-bind:placeholder="$t('name')">
    <input type="text" v-bind:placeholder="$t('email')">
    <input type="text" v-bind:placeholder="$t('password')">
    <input type="text" v-bind:placeholder="$t('confirm_password')">
    <button>{{$t('sign_up')}}</button>
  </div>
  
</template>