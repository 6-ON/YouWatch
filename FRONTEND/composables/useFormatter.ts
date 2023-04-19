export const useFormatter = () => {
  const formatter = new Intl.NumberFormat('en-US', {
    notation: "compact",
    maximumFractionDigits: 1
  })

  function formatDuration(seconds: number) {
    return new Date(1000 * seconds).toISOString().slice(14, 19)
  }

  return { formatDuration, formatter }
}
