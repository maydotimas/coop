/* All validations should be defined here */

export function isExternal(path) {
  return /^(https?:|mailto:|tel:)/.test(path);
}

/**
 * Validate a valid URL
 * @param {String} textval
 * @return {Boolean}
 */
export function validURL(url) {
  const reg = /^(https?|ftp):\/\/([a-zA-Z0-9.-]+(:[a-zA-Z0-9.&%$-]+)*@)*((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9][0-9]?)(\.(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[1-9]?[0-9])){3}|([a-zA-Z0-9-]+\.)*[a-zA-Z0-9-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(:[0-9]+)*(\/($|[a-zA-Z0-9.,?'\\+&%$#=~_-]+))*$/;
  return reg.test(url);
}

/**
 * Validate a full-lowercase string
 * @return {Boolean}
 * @param {String} str
 */
export function validLowerCase(str) {
  const reg = /^[a-z]+$/;
  return reg.test(str);
}

/**
 * Validate a full-uppercase string
 * @return {Boolean}
 * @param {String} str
 */
export function validUpperCase(str) {
  const reg = /^[A-Z]+$/;
  return reg.test(str);
}

/**
 * Check if a string contains only alphabet
 * @param {String} str
 * @param {Boolean}
 */
export function validAlphabets(str) {
  const reg = /^[A-Za-z]+$/;
  return reg.test(str);
}

/**
 * Check if a string contains only alphabet
 * @param {String} str
 * @param {Boolean}
 */
export function validAddress(str) {
  const reg = /^[A-Za-z0-9_ #,.]+$/;
  return reg.test(str);
}

/**
 * Check if a string contains special characters
 * @param {String} str
 * @param {Boolean}
 */
export function noSpecialCharacters(str) {
  const reg = /^[A-Za-z0-9_ #]+$/;
  return reg.test(str);
}

/**
 * Check if a string contains numbers
 * @param {String} str
 * @param {Boolean}
 */
export function validNumber(str) {
  const reg = /^([0-9]+\.?[0-9]*|\.[0-9]+)$/;
  return reg.test(str);
}

/**
 * Check if a string contains only valid name (alphabet and space)
 * @param {String} str
 * @param {Boolean}
 */
export function validName(str) {
  const reg = /^[A-Za-z ]+$/;
  return reg.test(str);
}

/**
 * Validate an email address
 * @param {String} email
 * @return {Boolean}
 */
export function validEmail(email) {
  const re = /^([\w-]+\.)*?[\w-]+@[\w-]+\.([\w-]+\.)*?[\w]+$/;
  return re.test(email);
}

/**
 * Validate an phone number
 * @param {String} phone_number
 * @return {Boolean}
 */
export function validPhone(phone_number) {
  const re = /^(09|\+639)\d{9}$/;
  return re.test(phone_number);
}
