using UnityEngine;
using System.Collections;
using UnityEngine.Networking;
using System.IO;
using UnityEngine.UI;

namespace LuaFramework {

    /// <summary>
    /// </summary>
    public class Main : MonoBehaviour {
        [SerializeField]
        GameObject loading;
        [SerializeField]
        RawImage rawimg_loading;
        [SerializeField]
        Image img_loading;
        [SerializeField]
        Text text_loading;
        [SerializeField]
        Image fill_loading;
        [SerializeField]
        RectTransform effect_loading;
        [SerializeField]
        RectTransform fill_width;
        IEnumerator Start() {
            LuaHelper.Loading = loading;
            LuaHelper.ImgLoading = img_loading;
            LuaHelper.RawimgLoading = rawimg_loading;
            LuaHelper.TextLoading = text_loading;
            LuaHelper.FillLoading = fill_loading;
            LuaHelper.EffectLoading = effect_loading;
            LuaHelper.FillWidth = fill_width;


            var setLogo = StartCoroutine(SetImage());
            yield return setLogo;

            var setUrl = StartCoroutine(SetUrl());
            yield return setUrl;

            AppFacade.Instance.StartUp();   //启动游戏
        }
        
        // 判断logo版本并且设置logo
        IEnumerator SetImage()
        {
            Texture2D loading = null;
            string version;
            // 获取资源版本号
            UnityWebRequest www = UnityWebRequest.Get(AppConst.url+"logo/logoVersion.php");
            yield return www.SendWebRequest();
            if (www.error != null)
            {
                Debug.LogError(www.error);
                yield break;
            }
            else
            {
                version = www.downloadHandler.text;
                PlayerPrefs.SetString("LogoVersion", www.downloadHandler.text);

                UnityWebRequest webRequest = UnityWebRequest.Get(AppConst.url + "logo/loading" + version + ".jpg");
                yield return webRequest.SendWebRequest();
                if (webRequest.error != null)
                {
                    Debug.LogError(webRequest.error);
                }
                else
                {
                    byte[] bytes = webRequest.downloadHandler.data;
                    loading = new Texture2D(1024, 512);
                    loading.LoadImage(bytes);
                    rawimg_loading.texture = loading;
                    rawimg_loading.enabled = true;
                }
            }
           Coroutine  setLogo = null;
            try
            {
                if (loading == null)
                {
                    var bytes = File.ReadAllBytes(Application.dataPath + "/loading.jpg");
                    loading = new Texture2D(1024, 512);
                    loading.LoadImage(bytes);
                    File.WriteAllBytes(Application.dataPath + "/loading.jpg", bytes);
                }
            }
            catch(System.Exception e)
            {
                Debug.Log("本地读取失败，重新从服务器读取:" + e.Message);
                PlayerPrefs.SetString("LogoVersion", "0");
                setLogo = StartCoroutine(SetImage());
            }
            if(setLogo!= null)
            {
                yield return setLogo;
            }
        }

        // 根据平台设置热更网址
        IEnumerator SetUrl()
        {
            WWWForm wWWForm = new WWWForm();
            wWWForm.AddField("platfrom", AppConst.Platfrom);
            wWWForm.AddField("channel", AppConst.Channel);
            UnityWebRequest www = UnityWebRequest.Post(AppConst.url + "hotupdateurl.php", wWWForm);
            yield return www.SendWebRequest();
            if (www.error != null)
            {
                Debug.LogError(www.error);
            }
            else
            {
                Debug.Log("热更网址 hotupdateurl = " + www.downloadHandler.text);
                AppConst.WebUrl = www.downloadHandler.text;
            }
        }
    }
}