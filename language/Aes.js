var crypto = require('crypto');

exports.AES = {
  encrypt: function encrypt (source, password, algorithm) {
    algorithm = algorithm || 'aes-128-ecb'
    var cipher = crypto.createCipher(algorithm, password);
    var encrypted = cipher.update(source, 'utf8', 'base64');
    encrypted += cipher.final('base64');
    return encrypted;
  },
  decrypt: function decrypt (encrypted, password, algorithm) {
    algorithm = algorithm || 'aes-128-ecb'
    var decipher = crypto.createDecipher(algorithm, password);
    var decrypted = decipher.update(encrypted, 'base64', 'utf8');
    decrypted += decipher.final('utf8');
    return decrypted;
  },
}
