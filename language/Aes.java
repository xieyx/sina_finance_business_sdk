import org.apache.commons.codec.binary.Base64;
import org.junit.Test;

import javax.crypto.Cipher;
import javax.crypto.spec.SecretKeySpec;
import java.security.MessageDigest;

public class AES {
    public static final String DEFAULT_CODING = "utf-8";

    //解密
    public static String decrypt(String encrypted, String seed) throws Exception {
        byte[] keyb = seed.getBytes(DEFAULT_CODING);
        MessageDigest md = MessageDigest.getInstance("MD5");
        byte[] thedigest = md.digest(keyb);
        SecretKeySpec skey = new SecretKeySpec(thedigest, "AES");
        Cipher dcipher = Cipher.getInstance("AES");
        dcipher.init(Cipher.DECRYPT_MODE, skey);

        byte[] clearbyte = dcipher.doFinal(Base64UtilsDecode(encrypted));
        return new String(clearbyte);
    }

    //加密
    public static String encrypt(String content, String key) throws Exception {
        byte[] input = content.getBytes(DEFAULT_CODING);

        MessageDigest md = MessageDigest.getInstance("MD5");
        byte[] thedigest = md.digest(key.getBytes(DEFAULT_CODING));
        SecretKeySpec skc = new SecretKeySpec(thedigest, "AES");
        Cipher cipher = Cipher.getInstance("AES/ECB/PKCS5Padding");
        cipher.init(Cipher.ENCRYPT_MODE, skc);

        byte[] cipherText = new byte[cipher.getOutputSize(input.length)];
        int ctLength = cipher.update(input, 0, input.length, cipherText, 0);
        ctLength += cipher.doFinal(cipherText, ctLength);

        return Base64UtilsEncode(cipherText);
    }


    /**
     * <p>
     * BASE64字符串解码为二进制数据
     * </p>
     *
     * @param base64
     * @return
     * @throws Exception
     */
    public static byte[] Base64UtilsDecode(String base64) throws Exception {
        return new Base64().decode(base64.getBytes());
    }

    /**
     * <p>
     * 二进制数据编码为BASE64字符串
     * </p>
     *
     * @param bytes
     * @return
     * @throws Exception
     */
    public static String Base64UtilsEncode(byte[] bytes) throws Exception {
        return new String(new Base64().encode(bytes));
    }

    @Test
    public static void main (String[] arg) throws Exception {
        String passwd = "USJBTDIIWwttUZ+7q6B0vmmXzwNO5ggPeFeC1KqtdhEkKZ3JOxvF7C00La/nIJbWvKmjyC4APHOzomrrf/H7d6stqcpXpfJ39oai2hSY4vZNWXIHRVnNQK+EvgqKU3/h91xW5s37OKWFNSmUpgh5Sn7ThJjqHaoffJZzVAMBpu8=";
        // LN5JZHpW0AZpQK4d+munPA==
        System.out.println(AESUtilForNode.encrypt("13717503886", passwd));
        System.out.println(AESUtilForNode.decrypt("ox+HiLE4L6vzn5toEsaXuthxbFOGatLNbGOakhzjZlF5Z4MiA339ZPOfUrBaC4qm", passwd));
    }
}
