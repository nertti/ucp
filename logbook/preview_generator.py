from PIL import Image

number_of_images = 128
images_width = 97
images_height = 72
total_width = images_width * 2
total_height = int((images_height * number_of_images)/2)

new_im = Image.new('RGB', (total_width, total_height))

images = []

for image in range(0, number_of_images):
    images.append("pages/{}.jpg".format(image))


for y in range(0, number_of_images):
   
    im = Image.open(images[y])
    im.thumbnail((images_width, images_height))
    
    if y%2 == 0:
        x = 0
        if y > 2:
            y = int(y/2)*images_height or images_height
        elif y == 1:
            y = 0
        elif y==2:
            y = images_height
        else:
            y=0
        #y = int(y-(y-1))*73 or 73
        
        
    else:
        x = images_width
        if y > 3:
            y = int((y-1)/2)*images_height or images_height
            #y = 73*y - 73*2
        elif y == 1:
            y = 0
        elif y==2:
            y = 2*images_height
        elif y==3:
            y = images_height
        else:
            y=0
        
    new_im.paste(im, (x, y))
    print(x, y)

    
    
    
new_im.show()
