import io, glob, os, sys, time, uuid, requests
import RPi.GPIO as GPIO
from io import BytesIO
from PIL import Image, ImageDraw
from azure.cognitiveservices.vision.face import FaceClient
from msrest.authentication import CognitiveServicesCredentials
from azure.cognitiveservices.vision.face.models import TrainingStatusType, Person, SnapshotObjectType, OperationStatusType
import requests
import picamera
from datetime import datetime
import time
from time import sleep
import lcd

now= datetime.now()

variable = (time.strftime("%Y-%m-%d:%H-%M-%S"))
filename = "/home/pi/Desktop/iotproject1/Captured/Image-" + variable + ".jpg"

# Set the FACE_SUBSCRIPTION_KEY environment variable with your key as the value.
# This key will serve all examples in this document.
KEY= os.getenv=('95c266a622f14ba396237d161aa50f8d')

ENDPOINT= 'https://iotproject.cognitiveservices.azure.com'

# Set the FACE_ENDPOINT environment variable with the endpoint from your Face service in Azure.
# This endpoint will be used in all examples in this quickstart.

# Create an authenticated FaceClient.
face_client = FaceClient(ENDPOINT, CognitiveServicesCredentials(KEY))

# Used in the Person Group Operations,  Snapshot Operations, and Delete Person Group examples.
# You can call list_person_groups to print a list of preexisting PersonGroups.
# SOURCE_PERSON_GROUP_ID should be all lowercase and alphanumeric. For example, 'mygroupname' (dashes are OK).
PERSON_GROUP_ID = 'authorized-faces'
# Used for the Snapshot and Delete Person Group examples.
TARGET_PERSON_GROUP_ID = str(uuid.uuid4()) # assign a random ID (or name it anything)

def imagecapture():
	with picamera.PiCamera() as camera:
		camera.resolution = (1280,720)
		camera.start_preview()
		sleep(5)
		camera.capture(filename)
		camera.stop_preview()

def persongroup():
    '''
    Create the PersonGroup
    '''
    # Create empty Person Group. Person Group ID must be lower case, alphanumeric, and/or with '-', '_'.
    print('Person group:', PERSON_GROUP_ID)
    face_client.person_group.create(person_group_id=PERSON_GROUP_ID, name=PERSON_GROUP_ID)

    # Define vishal as person
    vishal = face_client.person_group_person.create(PERSON_GROUP_ID, "vishal")
    # Define yogesh as person
    yogesh = face_client.person_group_person.create(PERSON_GROUP_ID, "yogesh")
    # Define amogh
    amogh = face_client.person_group_person.create(PERSON_GROUP_ID, "amogh")

    '''
    Detect faces and register to correct person
    '''
    # Find all jpeg images of friends in working directory
    vishal_images = [file for file in glob.glob('*.jpg') if file.startswith("vishal")]
    yogesh_images = [file for file in glob.glob('*.jpg') if file.startswith("yogesh")]
    amogh_images = [file for file in glob.glob('*.jpg') if file.startswith("amogh")]

    # Add to a woman person
    for image in vishal_images:
        w = open(image, 'r+b')
        face_client.person_group_person.add_face_from_stream(PERSON_GROUP_ID, vishal.person_id, w)

    # Add to a man person
    for image in yogesh_images:
        m = open(image, 'r+b')
        face_client.person_group_person.add_face_from_stream(PERSON_GROUP_ID, yogesh.person_id, m)

    # Add to a child person
    for image in amogh_images:
        ch = open(image, 'r+b')
        face_client.person_group_person.add_face_from_stream(PERSON_GROUP_ID, amogh.person_id, ch)

    ''' 
    Train PersonGroup
    '''
    print()
    print('Training the person group...')
    # Train the person group
    face_client.person_group.train(PERSON_GROUP_ID)

    while (True):
        training_status = face_client.person_group.get_training_status(PERSON_GROUP_ID)
        print("Training status: {}.".format(training_status.status))
        print()
        if (training_status.status is TrainingStatusType.succeeded):
            break
        elif (training_status.status is TrainingStatusType.failed):
            sys.exit('Training the person group has failed.')
        time.sleep(5)
 
def motor():
    GPIO.setwarnings(False)
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(03, GPIO.OUT)
    pwm=GPIO.PWM(03, 50)
    pwm.start(0)
    def SetAngle(angle):
        duty = angle / 18 + 2
        GPIO.output(03, True)
        pwm.ChangeDutyCycle(duty)
        sleep(1)
        GPIO.output(03, False)
        pwm.ChangeDutyCycle(0)	
    SetAngle(0) 
    pwm.stop()
    GPIO.cleanup()
 

lcd.lcd_init()

def lcdsuccessface():
    lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
    lcd.lcd_string("Welcome", 2)
    lcd.lcd_byte(lcd.LCD_LINE_2, lcd.LCD_CMD)
    lcd.lcd_string("Door Unlocked!", 2)
    
 
def lcdunsuccessface():
	lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
	lcd.lcd_string("No access", 2)
	lcd.lcd_byte(lcd.LCD_LINE_2, lcd.LCD_CMD)
	lcd.lcd_string("Not Unlocked!", 2)
	
	
def lcdnoface():
	lcd.lcd_byte(lcd.LCD_LINE_1, lcd.LCD_CMD)
	lcd.lcd_string("No Face", 2)
	lcd.lcd_byte(lcd.LCD_LINE_2, lcd.LCD_CMD)
	lcd.lcd_string("Not Unlocked!", 2)
	        
def identification:
	'''
	Identify a face against a defined PersonGroup
	'''
	# Reference image for testing against
	group_photo = filename
	IMAGES_FOLDER = os.path.join(os.path.dirname(os.path.realpath(__file__)))

	# Get test image
	test_image_array = glob.glob(os.path.join(IMAGES_FOLDER, group_photo))
	image = open(test_image_array[0], 'r+b')

	# Detect faces
	face_ids = []
	faces = face_client.face.detect_with_stream(image)
	for face in faces:
		face_ids.append(face.face_id)


	# Identify faces
	try:
		results = face_client.face.identify(face_ids, PERSON_GROUP_ID)
	except:
		print('Sorry, no faces are detected.')
		print('The Door will not unlock!')
		lcdnoface()
		time.sleep(3)
		lcd.GPIO.cleanup()
		exit()
	print('Identifying faces in {}') 

	try:
		for person in results:
				print('Person for face ID {} is identified in {} with a confidence of {}.'.format(person.face_id, os.path.basename(image.name), person.candidates[0].confidence)) # Get topmost confidence score
				print('The Door is now unlocked!')
				#motor()
				lcdsuccessface()
				time.sleep(3)
				lcd.GPIO.cleanup()           

	except:
		print('No person identified in the person group of authorized faces from the {}.'.format(os.path.basename(image.name)))
		print('The Door will not unlock!')
		lcdunsuccessface()
		time.sleep(3)
		lcd.GPIO.cleanup()
		exit()

GPIO.setmode(GPIO.BCM)

GPIO.setup(18, GPIO.IN, pull_up_down=GPIO.PUD_UP)

while True:
    input_state = GPIO.input(18)
    if input_state == False:
        imagecapture()
        identification()
        time.sleep(0.2)		    

