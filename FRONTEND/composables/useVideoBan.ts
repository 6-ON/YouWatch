export const useVideoBan = (id:number) => {
  const { $axios } = useNuxtApp();
  const videoBan =  useAsyncData('videoBan',async () => await $axios.post(`/api/videos/${id}/ban`), { immediate: false });
  const videoUnban =  useAsyncData('videoUnban',async () => await $axios.delete(`/api/videos/${id}/ban`), { immediate: false });
  
  videoBan.pending.value = false;
  videoUnban.pending.value = false;
  return { videoBan,videoUnban };
}
