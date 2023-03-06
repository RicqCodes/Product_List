export const validation = (formData, key, value) => {
  if (key !== null && value?.length === 0) {
    const error = `Please, submit required data`;
    return error;
  } else if (key === "sku") {
    if (value.length < 3 || value.length > 32) {
      const error = "Sku has to be greater than 3 and less than 11";
      return error;
    }
  }
};
