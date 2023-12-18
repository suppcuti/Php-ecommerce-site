import mysql.connector
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
import time,os,re

start_time = time.time()
options = webdriver.EdgeOptions()
prefs = {
    "profile.managed_default_content_settings.images": 2,
}
options.add_experimental_option("prefs", prefs)
extension_file_path = os.path.abspath(r"C:\Coding\Novel reader\cjpalhdlnbpafiamejdnhcphjbkeiagm.crx")
options.add_extension(extension_file_path)

driver = webdriver.Edge(options=options)
url = 'https://www.asos.com/men/sale/shoes-trainers/cat/?cid=1935&ctaref=hp|mw|sale|carousel|1|category|shoes'
driver.get(url)

urllist = [element.get_attribute("href") for element in driver.find_elements(By.CSS_SELECTOR, ".listingPage_HfNlp a")]

for item in urllist:
    if item == None or item == "":
        continue
    try:
        driver.get(item) # go to each detail page
        print(item)
    except:
        print(item)
    wait = WebDriverWait(driver,5)
    name=driver.find_element(By.XPATH,"/html/body/div[1]/div/main/div[4]/section/div/div[2]/div/span[1]/h1").text
    string = driver.find_element(By.XPATH,"/html/body/div[1]/div/main/div[4]/section/div/div[2]/div/span[2]/div/span[2]").text
    numeric_part = re.search(r"\d+", string).group()
    price = int(numeric_part) *100
    category = 'shoe'
    info = driver.find_element(By.XPATH,"/html/body/div[1]/div/main/div[4]/section/div/div[2]/div/span[3]/div[7]/ul/li[2]/div/div/div/div").get_attribute("textContent")


    mydb = mysql.connector.connect(
      host="localhost",
      user="root",
      database="ecommerce"
    )

    mycursor = mydb.cursor()
    sql = "INSERT INTO products (name , price  , category, info) VALUES (%s,%s,%s,%s)"
    val = (name,price,category,info)
    mycursor.execute(sql, val)

    mydb.commit()
    print(mycursor.rowcount, "record inserted.")
